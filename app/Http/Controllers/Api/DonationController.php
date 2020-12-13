<?php

namespace App\Http\Controllers\Api;

use App\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function donation(Request $req)
    {
        $donation = Donation::orderBy('id','desc')->get();

        return response()->json([
            'success' => true,
            'donation' => $donation
        ]);
    }
}
