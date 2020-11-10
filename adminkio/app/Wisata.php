<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Wisata extends Model
{
    protected $table = 'wisata';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nama', 'deskripsi', 'deskripsi_en', 'lokasi', 'image', 'type','status'];

    public static function getId(){
        return $getId = DB::table('wisata')->orderBy('id','DESC')->take(1)->get();
    }

    public static function getCount(){
        return $getCount = DB::table('wisata')->count();
    }

    public function a() {
        return substr($this->nama, 1, 1);
    }
}
