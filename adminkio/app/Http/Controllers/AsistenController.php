<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Asisten;
use DB;
use File;
use Session;
use Illuminate\Support\Facades\Storage;

class AsistenController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {

        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));

            $asistens = Asisten::leftJoin('master',function($join)
              {
                  $join->on('master.poss_id','=','special_assistance.type')
                  ->where( 'master.type','Assistance')
                  ->where('master.status','1');
              })
            ->select(['special_assistance.id','master.nama','special_assistance.name','special_assistance.status']);
            return DataTables::of($asistens)
            ->addColumn('action', function($asistens){
                return view('action.asisten', [
                    'model' => $asistens,
                    'form_url' => route('asisten.destroy', $asistens->id),
                    'edit_url' => route('asisten.edit', $asistens->id)]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $cba = DB::table('master')->where('type','Assistance')->get();
        return view('menu.sa.sa', compact('cba'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.sa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
			'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'file|mimes:mp4,avi,m4v|max:20480',
        ]);

        if($request->file('image') == ""){
            $nama_file = "no-image";
        }
        else{
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('image');

            $nama_file = time()."_".$file->getClientOriginalName();

                // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/assistance';
            $file->move($tujuan_upload,$nama_file);
        }

        $video = $request->file('video');

        $data=array();
        $data['name']=$request->name;
        $data['name_en']=$request->name_en;
        $data['deskripsi']=$request->deskripsi;
        $data['deskripsi_en']=$request->deskripsi_en;
        $data['type']=$request->type;
        $data['image']=$nama_file;
        $data['video']=$video->getClientOriginalName();

        DB::table('special_assistance')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Tenant Berhasil Ditambahkan"
           ]);
        return redirect()->route('asisten.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asistens = Asisten::find($id);
        $cba = DB::table('master')->where('type','Assistance')->get();
        return view('menu.sa.editsa', ['asistens' => $asistens, 'cba' => $cba])->with(compact('asistens','cba'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Asisten::find($id);
        $this->validate($request, [
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'file|mimes:mp4,avi,m4v|max:20480',
        ]);

        // Storage::delete($request->foto);

        if($request->file('image') == ""){
            $nama_file = $request->gb;
        }
        else{
            if($request->hasFile('image')){
                $file = $request->file('image');
                $nama_file = time()."_".$file->getClientOriginalName();
                    // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'gambar/assistance';
                $file->move($tujuan_upload,$nama_file);

                File::delete('gambar/assistance/' . $request->gb);
            }
        }

        if($request->file('video') == ""){
            $nama_video = $request->vd;
        }
        else{
            if($request->hasFile('video')){
                $video = $request->file('video');
                $nama_video = $video->getClientOriginalName();
            }
        }

        // menyimpan data file yang diupload ke variabel $file

        $status =$request->get('status')? 1 : 0 ?? 0;


        DB::table('special_assistance')->where('id',$request->id)
        ->update(['name' => $request->name,'name_en' => $request->name_en,'deskripsi' => $request->deskripsi,
        'deskripsi_en' => $request->deskripsi_en,'type' => $request->type, 'image' => $nama_file,'video' => $nama_video, 'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Special Asistence Berhasil DiUpdate"
        ]);
        return redirect()->route('asisten.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Asisten::find($id);
        File::delete('gambar/assistance/' . $image->image);

        DB::table('special_assistance')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Special Asistence Berhasil Dihapus"
           ]);
        return redirect()->route('asisten.index');
    }
}
