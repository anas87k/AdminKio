<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Tenant;
use DB;
use File;
use Session;
use GoogleTranslate;
use FindBrok\WatsonTranslate\Contracts\TranslatorInterface as WatsonTranslator;
//use FindBrok\WatsonTranslate\Translator as WatsonTranslate;
//use WatsonTranslate;
use Illuminate\Support\Facades\Storage;
use App\Wisata;

class TenantController extends Controller
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

    public function ab()
    {
      return Wisata::leftJoin('master',function($join)
        {
            $join->on('master.poss_id','=','wisata.type')
            ->where('master.type','Wisata')
            ->where('master.status','1');
        })
      ->select(['wisata.id','master.nama as nm','wisata.nama','wisata.type','wisata.status'])
      ->get();
    }

    public function a()
    {
        return $getcbt = DB::table('master')->where('type','tenant')->orderBy('id','DESC')->take(1)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
      if ($request->ajax()) {
        $tenant = Tenant::leftJoin('master',function($join)
          {
              $join->on('master.poss_id','=','tenants_fasilitas.type')
              ->where( 'master.type','Tenant')
              ->where('master.status','1');
          })
        ->select(['tenants_fasilitas.id as id','master.nama as nama','name_tenant','tenants_fasilitas.type','tenants_fasilitas.status']);
          return DataTables::of($tenant)
          ->addColumn('action', function($tenant){
              return view('action.tenant', [
                  'model' => $tenant,
                  'form_url' => route('tenant.destroy', $tenant->id),
                  'edit_url' => route('tenant.edit', $tenant->id)]);
          })
          ->rawColumns(['action'])
          ->make(true);
      }

      $cbt = DB::table('master')->where('type','tenant')->orderBy('id','DESC')->get();
      return view('menu.tenant.tenant',compact('cbt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.tenant');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, WatsonTranslator $translator){

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
            $tujuan_upload = 'gambar/tenant';
            $file->move($tujuan_upload,$nama_file);
        }

        //translate deskripsi
        //$deskripsi_en = GoogleTranslate::unlessLanguageIs('en', $request->deskripsi);
        //$deskripsi_en = WatsonTranslate::from('id')->to('en')->bulkTranslate($request->deskripsi)->collectResults();
        //$deskripsi_en = $translator->from('id')->to('en')->bulkTranslate($request->deskripsi)->getTranslation();


        $data=array();
        $data['name_tenant']=$request->name_tenant;
        $data['lantai_1']=$request->get('lantai_1')? 1 : 0 ?? 0;
        $data['lantai_2']=$request->get('lantai_2')? 1 : 0 ?? 0;
        $data['mezanine']=$request->get('mezanine')? 1 : 0 ?? 0;
        $data['deskripsi']=$request->deskripsi;
        $data['deskripsi_en']=$request->deskripsi_en;
        $data['type']=$request->type;
        $data['image']=$nama_file;

        DB::table('tenants_fasilitas')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Tenant Berhasil Ditambahkan"
           ]);
        return redirect()->route('tenant.index');
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
        $tenants = Tenant::find($id);
        $cbt = DB::table('master')->where('type','tenant')->get();
        return view('menu.tenant.edittenant', ['tenants' => $tenants, 'cbt '=> $cbt])->with(compact('tenants','cbt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WatsonTranslator $translator, $id)
    {
        $post = Tenant::find($id);
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
                $tujuan_upload = 'gambar/tenant';
                // menyimpan data file yang diupload ke variabel $file
                $file->move($tujuan_upload,$nama_file);

                File::delete('gambar/tenant/' . $request->gb);
            }
        }

        //$deskripsi_en = WatsonTranslate::from('id')->to('en')->bulkTranslate($request->deskripsi)->collectResults();
        //$deskripsi_en = $translator->from('id')->to('en')->bulkTranslate($request->deskripsi)->getTranslation();

        $nama = $request->name_tenant;
        $lantai1 = $request->get('lantai_1')? 1 : 0 ?? 0;
        $lantai2 = $request->get('lantai_2')? 1 : 0 ?? 0;
        $mezanine = $request->get('mezanine')? 1 : 0 ?? 0;
        $desc = $request->deskripsi;
        $en_desc = $request->deskripsi_en;
        $type = $request->type;
        $status = $request->get('status')? 1 : 0 ?? 0;



        DB::table('tenants_fasilitas')->where('id',$request->id)
        ->update(['name_tenant' => $nama, 'lantai_1' => $lantai1, 'lantai_2' => $lantai2,
        'mezanine' => $mezanine, 'deskripsi' => $desc, 'deskripsi_en' => $en_desc,'type' => $type,
        'image' => $nama_file, 'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Tenant Berhasil DiUpdate"
        ]);
        return redirect()->route('tenant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($no)
    {
        $image = Tenant::find($no);
        File::delete('gambar/tenant/' . $image->image);

        DB::table('tenants_fasilitas')->where('id',$no)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Tenant Berhasil Dihapus"
           ]);
        return redirect()->route('tenant.index');
    }
}
