<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Master extends Model
{
    protected $table = 'master';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['type','poss_id','nama'];

    public function Tenant(){
        return $this->hasMany('App\Tenant');
    }

    public static function getcbt(){
        return $getcbt = DB::table('master')->where('type','tenant')->orderBy('id','DESC')->take(1)->get();
    }

    public static function getcbw(){
        return $getcbw = DB::table('master')->where('type','wisata')->orderBy('id','DESC')->take(1)->get();
    }

    public static function getcba(){
        return $getcba = DB::table('master')->where('type','assisten')->orderBy('id','DESC')->take(1)->get();
    }
}
