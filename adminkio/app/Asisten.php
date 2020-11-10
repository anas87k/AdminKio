<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Asisten extends Model
{
    protected $table = 'special_assistance';
    public $primaryKey = 'id';
    public $unique = 'poss_id';
    public $timestamps = false;
    protected $fillable = ['name','deskripsi', 'type', 'image', 'status','video'];

    public static function getId(){
        return $getId = DB::table('special_asistence')->orderBy('id','DESC')->take(1)->get();
    }

    public static function getCount(){
        return $getCount = DB::table('special_asistence')->count();
    }
}
