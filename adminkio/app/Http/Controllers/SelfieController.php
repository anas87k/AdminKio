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
use Yajra\DataTables\Html\Editor\Fields\Select;

class SelfieController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
      if ($request->ajax()) {
        $qr = DB::table('qr')->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','qrname','foto','status']);
        return DataTables::of($qr)
        ->addColumn('action', function($qr){
            return view('action.selfie', [
                'model' => $qr,
                'form_url' => route('selfie.destroy', $qr->id),
                'edit_url' => route('selfie.edit', $qr->id)]);
        })
          ->rawColumns(['action'])
          ->make(true);
      }
        return view('menu.selfie');
    }

    public function edit($id)
    {
        $qr = DB::table('qr')->find($id);
        return view('menu.editselfie', ['qr' => $qr])->with(compact('qr'));
    }

    public function update(Request $request, $id)
    {
        $status =$request->get('status')? 1 : 0 ?? 0;

        DB::table('qr')->where('id',$request->id)
        ->update(['status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Selfie Berhasil DiUpdate"
        ]);
        return redirect()->route('selfie.index');
    }


    public function Tenantdestroy($id)
    {
        $image = DB::table('qr')->where('id', $id)->first();
        File::delete('gambar/selfie/image/' . $image->foto);
        File::delete('gambar/selfie/qr/' . $image->qrname);

        DB::table('qr')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Selfie Berhasil Dihapus"
           ]);
        return redirect()->route('selfie.index');
    }
}
