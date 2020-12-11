<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kajian;
use Illuminate\Support\Facades\Auth;

class KajianController extends Controller
{
    public function kajian()
    {
        $kajian = Kajian::orderBy('id','desc')->get();
        foreach ($kajian as $kaj) {
            $kaj['selfSave'] = false;
            $kaj['user'] = $kaj->user;
            foreach ($kaj->simpankajian as $simpan) {
                if($simpan->id_user == Auth::user()->id){
                    $kaj['selfSave'] = true;
                }
            }
        }

        return response()->json([
            'success' => true,
            'allKajian' => $kajian
        ]);
    }

    public function create(Request $req)
    {
        $kajian = new Kajian();
        $kajian->id_user = Auth::user()->id;
        $kajian->kode_kajian = $kajian->kodekajian();
        $kajian->tanggal_kajian = $req->tanggal_kajian;
        $kajian->jenis_kajian = $req->jenis_kajian;
        $kajian->pengisi_kajian = $req->pengisi_kajian;
        $kajian->lokasi_kajian = $req->lokasi_kajian;
        $kajian->deskripsi_kajian = $req->deskripsi_kajian;
        $kajian->kategori_kajian = $req->kategori_kajian;

        if($req->photo != ''){
            $photo = time().'jpg';
            file_put_contents('storage/kajian/'.$photo, base64_decode($req->photo));
            $kajian->poster_kajian = $photo;
        }

        $kajian->save();
        $kajian->user;
        return response()->json([
            'success' => true,
            'message' => 'posted',
            'kajian' => $kajian
        ]);
    }

    public function findByKode(Request $req)
    {
        $kajian = Kajian::where('kode_kajian', $req->kode_kajian)->get();
        return response()->json([
            'success' => true,
            'detail' => $kajian
        ]);
    }

    public function findByLocation(Request $req)
    {
        $kajian = Kajian::where('lokasi_kajian', $req->lokasi_kajian)->get();
        return response()->json([
            'success' => true,
            'detail' => $kajian
        ]);
    }

    public function findByJenisKajian(Request $req)
    {
        $kajian = Kajian::where('jenis_kajian', $req->jenis_kajian)->get();
        return response()->json([
            'success' => true,
            'detail' => $kajian
        ]);
    }
}
