<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kajian;

class Simpankajian extends Model
{
    protected $table = 'tbl_simpankajian';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function simpankajian()
    {
        return $this->belongsTo('App\Kajian', 'id_kajian');
    }

    public function tambahsimpan($idkajian)
    {
        $kajian = Kajian::find($idkajian);
        $kajian->suka_kajian += 1;
        $kajian->save();
    }
}
