<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hyundai extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'HYUNDAI');
        //SessionController@storeSessionData;
        $products = DB::table('hyundaiprices')->paginate(19);
        $recordscount = DB::table('hyundaiprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
