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

class CobaController extends Controller
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

    public function a()
    {
        return $getcbt = DB::table('master')->where('type','tenant')->orderBy('id','DESC')->take(1)->get();
    }

    public function index()
    {
      DB::statement(DB::raw('set @rownum=0'));
      $tenant = Tenant::leftJoin('master',function($join)
        {
            $join->on('master.poss_id','=','tenants_fasilitas.type')
            ->where( 'master.type','Tenant')
            ->where('master.status','1');
        })
      ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'no','master.nama','tenants_fasilitas.poss_id AS id','name_tenant','tenants_fasilitas.type','tenants_fasilitas.status'])
      ->get();

      $cbt = DB::table('master')->where('type','tenant')->orderBy('id','DESC')->take(1)->get();
      return view('menu.dataTenant',compact('tenant','cbt'));

      // $Tenants = Tenant::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'no','poss_id','name_tenant','type','status']);
      // return DataTables::of($Tenants)
      // ->addColumn('type', function($Tenants){
      //     //$a = DB::select('select master.nama from master where $Tenants->type = master.poss_id AND master.type="tenant"');
      //     $users = DB::table('master')
      //     ->where(['poss_id' => $Tenants->type, 'type'=>'Tenant'])
      //     ->select('nama')
      //     ->get();
      //     return $users;

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
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
