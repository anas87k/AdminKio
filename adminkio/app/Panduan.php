<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Panduan extends Model
{
    protected $table = 'panduan_bandara';
    public $primaryKey = 'id';
    public $unique = 'post_id';
    public $timestamps = false;
    protected $fillable = ['post_title','post_desc','en_desc','status'];

    public static function getId(){
        return $getId = DB::table('panduan_bandara')->orderBy('id','DESC')->take(1)->get();
    }

    public static function getCount(){
        return $getCount = DB::table('tenants_fasilitas')->count();
    }
}
