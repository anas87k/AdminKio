<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Wisata;
use DB;
use QrCode;
use Session;
use Illuminate\Support\Facades\File;

class WisataController extends Controller
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
            $Wisata = Wisata::leftJoin('master',function($join)
              {
                  $join->on('master.poss_id','=','wisata.type')
                  ->where('master.type','Wisata')
                  ->where('master.status','1');
              })
            ->select(['wisata.id','master.nama as nm','wisata.nama','wisata.type','wisata.status']);
            return DataTables::of($Wisata)
            ->addColumn('action', function($Wisata){
                return view('action.wisata', [
                    'model' => $Wisata,
                    'form_url' => route('wisata.destroy', $Wisata->id),
                    'edit_url' => route('wisata.edit', $Wisata->id)]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $cbw = DB::table('master')->where('type','wisata')->get();
        return view('menu.wisata.wisata', compact('cbw'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ]);
        // menyimpan data file yang diupload ke variabel $file
        if($request->file('image') == ""){
            $nama_file = "no-image";
        }
        else{
            $file = $request->file('image');

            $nama_file = time()."_".$file->getClientOriginalName();

                // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/wisata';
            $file->move($tujuan_upload,$nama_file);
        }
        $aa = 'qr-'.time().'.png';
        $qrt = 'gambar/wisata/qr/'.$aa;

        $data=array();
        $data['nama']=$request->nama;
        $data['deskripsi']=$request->deskripsi;
        $data['deskripsi_en'] = $request->deskripsi_en;
        $data['lokasi']=$request->lokasi;
        $data['qrlink']=$aa;
        $data['image']=$nama_file;
        $data['type']=$request->type;

        QrCode::format('png')->size(200)->margin(1)->merge('assets/images/a.png', .3, true)->generate($request->link, $qrt);
        DB::table('wisata')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Wisata Berhasil Ditambahkan"
           ]);
        return redirect()->route('wisata.index');
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
        $wisata = Wisata::find($id);
        $cbw = DB::table('master')->where('type','wisata')->get();
        return view('menu.wisata.editwisata', ['wisata' => $wisata,'cbw'=>$cbw])->with(compact('wisata','cbw'));
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
        $wisata = Wisata::find($id);
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
                $tujuan_upload = 'gambar/wisata';
                $file->move($tujuan_upload,$nama_file);

                File::delete('gambar/wisata/' . $request->gb);
            }
        }

        $status =$request->get('status')? 1 : 0 ?? 0;

        $aa = 'qr-'.time().'.png';
        $qrt = 'gambar/wisata/qr/'.$aa;
        File::delete('gambar/wisata/qr/' . $request->aa);

        if($request->link == ""){
            DB::table('wisata')->where('id',$request->id)
            ->update(['nama' => $request->nama,'deskripsi' => $request->deskripsi,'deskripsi_en' => $request->deskripsi_en,
            'lokasi' => $request->lokasi, 'image'=>$nama_file, 'type' => $request->type, 'status' => $status]);
        }else{
            QrCode::format('png')->size(200)->margin(1)->merge('assets/images/a.png', .3, true)->generate($request->link, $qrt);
            DB::table('wisata')->where('id',$request->id)
            ->update(['nama' => $request->nama,'deskripsi' => $request->deskripsi,'deskripsi_en' => $request->deskripsi_en,
            'lokasi' => $request->lokasi,'qrlink'=>$aa, 'image'=>$nama_file, 'type' => $request->type, 'status' => $status]);
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Wisata Berhasil DiUpdate"
        ]);
        return redirect()->route('wisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = DB::table('wisata')->where('id', $id)->first();
        File::delete('gambar/wisata/' . $image->image);

        DB::table('wisata')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Wisata Berhasil Dihapus"
           ]);
        return redirect()->route('wisata.index');
    }
}
