<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Panduan;
use DB;
use File;
use Session;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
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
            $panduan = Panduan::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','post_title','post_desc','status']);
            return DataTables::of($panduan)
            ->addColumn('action', function($panduan){
                return view('action.panduan', [
                    'model' => $panduan,
                    'form_url' => route('panduan.destroy', $panduan->id),
                    'edit_url' => route('panduan.edit', $panduan->id)]);
            })
            ->addColumn('status', function($panduan){
            if ($panduan->status == '1'){
                return '<span class="badge badge-success">Aktif</span>';
            } elseif ($panduan->status == '0'){
                return '<span class="badge badge-danger">Tidak Aktif</span>';
            };
                })
            ->rawColumns(['status','action'])
            ->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data'=>'rownum', 'name'=>'rownum', 'title'=>'No.', 'searchable' => false])
            ->addColumn(['data'=>'post_title', 'name'=>'post_title', 'title'=>'Nama'])
            ->addColumn(['data'=>'status', 'name'=>'status', 'title'=>'Status','orderable'
            => false])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'Action','orderable'
            => false, 'searchable' => false]);

        return view('menu.panduan', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.panduan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=array();
        $data['post_title']=$request->post_title;
        $data['en_title']=$request->en_title;
        $data['post_desc']=$request->post_desc;
        $data['en_desc']=$request->en_desc;

        DB::table('panduan_bandara')->insert($data);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Panduan Bandara Berhasil Ditambahkan"
           ]);
        return redirect()->route('panduan.index');
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
        $panduan = Panduan::find($id);
        return view('menu.editpanduan', ['panduan' => $panduan])->with(compact('panduan'));
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
        $status =$request->get('status')? 1 : 0 ?? 0;

        DB::table('panduan_bandara')->where('id',$request->id)
        ->update(['post_title' => $request->post_title,'en_title' => $request->en_title,
                'post_desc' => $request->post_desc,'en_desc' => $request->en_desc,'status' => $status]);


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Panduan Bandara Berhasil DiUpdate"
        ]);
        return redirect()->route('panduan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('panduan_bandara')->where('id',$id)->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Panduan Bandara Berhasil Dihapus"
           ]);
        return redirect()->route('panduan.index');
    }
}
