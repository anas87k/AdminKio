<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\QueryDataTable;
use App\Tenant;
use App\Wisata;
use App\Asisten;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request, Builder $htmlBuilder)
    // {
    //     if ($request->ajax()) {
    //         $Tenants = Tenant::select(['poss_id','name_tenant','type','status']);
    //         return DataTables::of($Tenants)
    //         ->make(true);
    //     }

    //     $html = $htmlBuilder
    //         ->addColumn(['data'=>'poss_id', 'name'=>'poss_id', 'title'=>'ID'])
    //         ->addColumn(['data'=>'name_tenant', 'name'=>'name_tenant', 'title'=>'Nama'])
    //         ->addColumn(['data'=>'type', 'name'=>'type', 'title'=>'Type'])
    //         ->addColumn(['data'=>'status', 'name'=>'status', 'title'=>'Status','orderable'
    //         => false, 'searchable' => false]);

    //     return view('home', compact('html'));
    // }
    public function create()
    {

        return view('menu.tenant');
    }
    public function jsontenant(){

        return DataTables::of(DB::table('tenants_fasilitas')->take(5))->toJson();
        // return DataTables::queryBuilder(DB::table('tenants_fasilitas')->orderBy('poss_id','DESC'))->take(5)->make(true);
        // return DataTables::of(Tenant::all()->orderBy('poss_id','DESC')->take(5))->make(true);
    }
    public function jsonwisata(){
        return DataTables::of(DB::table('wisata')->orderBy('id','DESC')->take(5))->toJson();
        // return DataTables::of(Wisata::all()->take(5))->make(true);
    }
    public function jsonasisten(){
        return DataTables::of(Asisten::all()->take(5))-toJson();
    }

    public function index(Request $request)
    {
        $tf = DB::table('tenants_fasilitas')->count();
        $wi = DB::table('wisata')->count();
        $sa = Asisten::all()->count();
        return view('home1',['tf'=>$tf, 'wi'=>$wi, 'sa'=>$sa]);
    }

    public function store(Request $request){

        $this->validate($request, [
			'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('image');

		$nama_file = time()."_".$file->getClientOriginalName();

      	    // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'gambar';
        $file->move($tujuan_upload,$nama_file);

        $id = Tenant::getId();
        foreach ($id as $value);
        $idlm = $value->no;
        $idbaru = $idlm + 1;
        $ids = 'poss0'.$idbaru;

        $data=array();
        $data['poss_id']=$ids;
        $data['name_tenant']=$request->name_tenant;
        $data['lantai_1']=$request->lantai_1;
        $data['lantai_2']=$request->lantai_2;
        $data['mezanine']=$request->mezanine;
        $data['deskripsi']=$request->deskripsi;
        $data['type']=$request->type;
        $data['image']=$nama_file;
        $data['status']=$request->status;

        DB::table('tenants_fasilitas')->insert($data);
        return redirect()->route('home');
    }

    public function edit($poss_id)
    {
        $tenants = Tenant::find($poss_id);
        return view('menu.edittenant', ['tenants' => $tenants])->with(compact('tenants'));
    }

    public function update(Request $request)
    {
        $post = array();
        $data['name_tenant']=$request->name_tenant;
        $data['lantai_1']=$request->lantai_1;
        $data['lantai_2']=$request->lantai_2;
        $data['mezanine']=$request->mezanine;
        $data['deskripsi']=$request->deskripsi;
        $data['type']=$request->type;
        $data['image']=$request->image;
        $data['status']=$request->status;

        DB::table('tenants_fasilitas')->where('poss_id',$request->poss_id)
        ->update(['name_tenant' => $request->name_tenant,'lantai_1' => $request->lantai_1,'lantai_2' => $request->lantai_2,
        'mezanine' => $request->mezanine,'deskripsi' => $request->deskripsi,'type' => $request->type]);
        return redirect()->route('home');
    }

}
