<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Master;
use App\Tenant;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use File;
use Session;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $te = DB::table('master')->where('type','Tenant')->count();
        //$pa = DB::table('master')->where('type',2)->count();
        $wi = DB::table('master')->where('type','Wisata')->count();
        $sa = DB::table('master')->where('type','Assistance')->count();
        $fa = DB::table('master')->where('type',2)->count();
        //$ = DB::table('master')->where('type',3)->count();
        return view('master.utama',['te'=>$te, 'sa'=>$sa, 'wi'=>$wi]);
    }

    public function Tenantindex(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $tenant = DB::table('master')->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','type','poss_id','nama','status'])->where('Type','Tenant');
            return DataTables::of($tenant)
            ->addColumn('action', function($tenant){
                return view('master.action.tenant', [
                    'model' => $tenant,
                    'form_url' => route('masterte.destroy', $tenant->id),
                    'edit_url' => route('masterte.edit', $tenant->id)]);
            })
            ->addColumn('status', function($tenant){
            if ($tenant->status == '1'){
                return '<span class="badge badge-success">Aktif</span>';
            } elseif ($tenant->status == '0'){
                return '<span class="badge badge-danger">Tidak Aktif</span>';
            };
                })
            ->rawColumns(['status','action'])
            ->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data'=>'rownum', 'name'=>'rownum', 'title'=>'No.', 'searchable' => false])
            ->addColumn(['data'=>'nama', 'name'=>'post_title', 'title'=>'Nama'])
            ->addColumn(['data'=>'status', 'name'=>'status', 'title'=>'Status','orderable'
            => false])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'Action','orderable'
            => false, 'searchable' => false]);

        return view('master.tenant', compact('html'));
    }

    public function Tenantstore(Request $request)
    {

        $id = Master::getcbt();
        foreach ($id as $value);
        $idlm = $value->poss_id;
        $idbaru = $idlm + 1;

        $type = 'Tenant';

        $data=array();
        $data['poss_id']=$idbaru;
        $data['nama']=$request->nama;
        $data['type']=$type;

        DB::table('master')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Tenant Berhasil Ditambahkan"
           ]);
        return redirect()->route('masterte.index');
    }

    public function Tenantedit($id)
    {
        $tenant = DB::table('master')->where('Type','Tenant')->find($id);
        return view('master.edittenant', ['tenant' => $tenant])->with(compact('tenant'));
    }

    public function Tenantupdate(Request $request, $id)
    {
        $status =$request->get('status')? 1 : 0 ?? 0;

        DB::table('master')->where('id',$request->id)
        ->update(['nama' => $request->nama,'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Tenant Berhasil DiUpdate"
        ]);
        return redirect()->route('masterte.index');
    }

    public function Tenantdestroy($id)
    {
        DB::table('master')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Tenant Berhasil Dihapus"
           ]);
        return redirect()->route('masterte.index');
    }

    //Controller Wisata

    public function Wisataindex(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $wisata = DB::table('master')->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','type','poss_id','nama','status'])->where('Type','Wisata');
            return DataTables::of($wisata)
            ->addColumn('action', function($wisata){
                return view('master.action.wisata', [
                    'model' => $wisata,
                    'form_url' => route('masterwi.destroy', $wisata->id),
                    'edit_url' => route('masterwi.edit', $wisata->id)]);
            })
            ->addColumn('status', function($wisata){
            if ($wisata->status == '1'){
                return '<span class="badge badge-success">Aktif</span>';
            } elseif ($wisata->status == '0'){
                return '<span class="badge badge-danger">Tidak Aktif</span>';
            };
                })
            ->rawColumns(['status','action'])
            ->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data'=>'rownum', 'name'=>'rownum', 'title'=>'No.', 'searchable' => false])
            ->addColumn(['data'=>'nama', 'name'=>'post_title', 'title'=>'Nama'])
            ->addColumn(['data'=>'status', 'name'=>'status', 'title'=>'Status','orderable'
            => false])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'Action','orderable'
            => false, 'searchable' => false]);

        return view('master.wisata', compact('html'));
    }

    public function Wisatastore(Request $request)
    {

        $id = Master::getcbw();
        foreach ($id as $value);
        $idlm = $value->poss_id;
        $idbaru = $idlm + 1;

        $type = 'Wisata';

        $data=array();
        $data['poss_id']=$idbaru;
        $data['nama']=$request->nama;
        $data['type']=$type;

        DB::table('master')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Wisata Berhasil Ditambahkan"
           ]);
        return redirect()->route('masterwi.index');
    }

    public function Wisataedit($id)
    {
        $wisata = DB::table('master')->where('Type','Wisata')->find($id);
        return view('master.editwisata', ['wisata' => $wisata])->with(compact('wisata'));
    }

    public function Wisataupdate(Request $request, $id)
    {
        $status =$request->get('status')? 1 : 0 ?? 0;

        DB::table('master')->where('id',$request->id)
        ->update(['nama' => $request->nama,'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Wisata Berhasil DiUpdate"
        ]);
        return redirect()->route('masterwi.index');
    }

    public function Wisatadestroy($id)
    {
        DB::table('master')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Wisata Berhasil Dihapus"
           ]);
        return redirect()->route('masterwi.index');
    }

    //Controller Assisten

    public function Asistenindex(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $asisten = DB::table('master')->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','type','poss_id','nama','status'])->where('Type','Assistance');
            return DataTables::of($asisten)
            ->addColumn('action', function($asisten){
                return view('master.action.asisten', [
                    'model' => $asisten,
                    'form_url' => route('masteras.destroy', $asisten->id),
                    'edit_url' => route('masteras.edit', $asisten->id)]);
            })
            ->addColumn('status', function($asisten){
            if ($asisten->status == '1'){
                return '<span class="badge badge-success">Aktif</span>';
            } elseif ($asisten->status == '0'){
                return '<span class="badge badge-danger">Tidak Aktif</span>';
            };
                })
            ->rawColumns(['status','action'])
            ->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data'=>'rownum', 'name'=>'rownum', 'title'=>'No.', 'searchable' => false])
            ->addColumn(['data'=>'nama', 'name'=>'post_title', 'title'=>'Nama'])
            ->addColumn(['data'=>'status', 'name'=>'status', 'title'=>'Status','orderable'
            => false])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'Action','orderable'
            => false, 'searchable' => false]);

        return view('master.asisten', compact('html'));
    }

    public function Asistenstore(Request $request)
    {

        $id = Master::getcba();
        foreach ($id as $value);
        $idlm = $value->poss_id;
        $idbaru = $idlm + 1;

        $type = 'Assistance';

        $data=array();
        $data['poss_id']=$idbaru;
        $data['nama']=$request->nama;
        $data['type']=$type;

        DB::table('master')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Special Assistance Berhasil Ditambahkan"
           ]);
        return redirect()->route('masteras.index');
    }

    public function Asistenedit($id)
    {
        $asisten = DB::table('master')->where('Type','Assistance')->find($id);
        return view('master.editasisten', ['asisten' => $asisten])->with(compact('asisten'));
    }

    public function Asistenupdate(Request $request, $id)
    {
        $status =$request->get('status')? 1 : 0 ?? 0;

        DB::table('master')->where('id',$request->id)
        ->update(['nama' => $request->nama,'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Special Assistance Berhasil DiUpdate"
        ]);
        return redirect()->route('masteras.index');
    }

    public function Asistendestroy($id)
    {
        DB::table('master')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Master Special Assistance Berhasil Dihapus"
           ]);
        return redirect()->route('masteras.index');
    }
}
