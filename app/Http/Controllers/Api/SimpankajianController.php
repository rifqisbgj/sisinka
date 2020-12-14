<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kajian;
use App\Simpankajian;
use Illuminate\Support\Facades\Auth;

class SimpankajianController extends Controller
{
    public function simpankajian(Request $req)
    {
        $simpan = Simpankajian::where('id_kajian',$req->id_kajian)->where('id_user',Auth::user()->id)->get();
        $a = Kajian::where('id',$req->id_kajian)->first();
        if(count($simpan)>0){
            $a->suka_kajian -= 1;
            $simpan[0]->delete();
            return response()->json([
                'success' => true,
                'message' => 'unliked'
            ]);
        }

        $simpan = new Simpankajian;
        $simpan->id_kajian = $req->id_kajian;
        $simpan->id_user = Auth::user()->id;
        $a->suka_kajian += 1;
        $simpan->tambahsimpan($req->id_kajian);
        $simpan->save();

        return response()->json([
            'success' => true,
            'message' => 'liked'
        ]);
    }
}
