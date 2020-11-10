<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use App\Master;

class Tenant extends Model
{
    protected $table = 'tenants_fasilitas';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name_tenant', 'lantai_1', 'lantai_2', 'mezanine', 'deskripsi','deskripsi_en', 'type', 'image', 'status'];

    public static function getId(){
        return $getId = DB::table('tenants_fasilitas')->orderBy('no','DESC')->take(1)->get();
    }

    public static function getCount(){
        return $getCount = DB::table('tenants_fasilitas')->count();
    }

    public function master(){
    	return $this->belongsTo(Master::class);
    }

}
