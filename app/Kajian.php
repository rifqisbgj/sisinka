<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kajian extends Model
{
    protected $table = 'tbl_kajian';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function simpankajian()
    {
        return $this->hasMany('App\Simpankajian','id_kajian');
    }

    public function kodekajian()
    {
        $ck = DB::table('tbl_kajian')->orderBy('kode_kajian','desc')->take(1)->value('kode_kajian');
        if($ck == NULL){
            $newKode = 'KJ00001';
            return $newKode;
        }
        $newKode = ++$ck;
        return $newKode;
    }

}
