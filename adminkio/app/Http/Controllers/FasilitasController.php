<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Tenant;
use DB;
use File;
use Session;

class FasilitasController extends Controller
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
            $fasilitas = DB::table('fasilitas')->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','nama','status']);
            return DataTables::of($fasilitas)
            ->addColumn('status', function($fasilitas){
            if ($fasilitas->status == '1'){
                return '<span class="badge badge-success">Aktif</span>';
            } elseif ($fasilitas->status == '0'){
                return '<span class="badge badge-danger">Tidak Aktif</span>';
            };
                })
            ->addColumn('action', function($fasilitas){
                return view('action.tenant', [
                    'model' => $fasilitas,
                    'form_url' => route('fasilitas.destroy', $fasilitas->id),
                    'edit_url' => route('fasilitas.edit', $fasilitas->id)]);
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data'=>'rownum', 'name'=>'rownum', 'title'=>'No.', 'searchable' => false])
            ->addColumn(['data'=>'nama', 'name'=>'nama', 'title'=>'Nama'])
            ->addColumn(['data'=>'status', 'name'=>'status', 'title'=>'Status','orderable'
            => false])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'Action','orderable'
            => false, 'searchable' => false]);

        return view('menu.fasilitas', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.fasilitas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        //save image
        $this->validate($request, [
			'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->file('image') == ""){
            $nama_file = "no-image";
        }
        else{
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('image');

            $nama_file = time()."_".$file->getClientOriginalName();

                // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/fasilitas';
            $file->move($tujuan_upload,$nama_file);
        }

        $data=array();
        $data['nama']=$request->nama;
        $data['lantai_1']=$request->get('lantai_1')? 1 : 0 ?? 0;
        $data['lantai_2']=$request->get('lantai_2')? 1 : 0 ?? 0;
        $data['mezanine']=$request->get('mezanine')? 1 : 0 ?? 0;
        $data['foto']=$nama_file;

        DB::table('fasilitas')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Fasilitas Berhasil Ditambahkan"
           ]);
        return redirect()->route('fasilitas.index');
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
    public function edit($no)
    {
        $fasilitas = DB::table('fasilitas')->find($no);
        return view('menu.editfasilitas', ['fasilitas' => $fasilitas])->with(compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no)
    {
        $post = Tenant::find($no);
        $this->validate($request, [
			'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
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
                $tujuan_upload = 'gambar/fasilitas';
                // menyimpan data file yang diupload ke variabel $file
                $file->move($tujuan_upload,$nama_file);

                File::delete('gambar/fasilitas/' . $request->gb);
            }
        }

        //$deskripsi_en = WatsonTranslate::from('id')->to('en')->bulkTranslate($request->deskripsi)->collectResults();
        //$deskripsi_en = $translator->from('id')->to('en')->bulkTranslate($request->deskripsi)->getTranslation();

        $nama = $request->nama;
        $lantai1 = $request->get('lantai_1')? 1 : 0 ?? 0;
        $lantai2 = $request->get('lantai_2')? 1 : 0 ?? 0;
        $mezanine = $request->get('mezanine')? 1 : 0 ?? 0;
        $status = $request->get('status')? 1 : 0 ?? 0;



        DB::table('fasilitas')->where('id',$request->no)
        ->update(['nama' => $nama, 'lantai_1' => $lantai1, 'lantai_2' => $lantai2,
        'mezanine' => $mezanine,'foto' => $nama_file, 'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Fasilitas Berhasil DiUpdate"
        ]);
        return redirect()->route('fasilitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = DB::table('fasilitas')->find($id);
        File::delete('gambar/fasilitas/' . $image->foto);

        DB::table('fasilitas')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Fasilitas Berhasil Dihapus"
           ]);
        return redirect()->route('fasilitas.index');
    }
}
