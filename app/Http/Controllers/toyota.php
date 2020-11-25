<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class toyota extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'TOYOTA');
        //SessionController@storeSessionData;
        $products = DB::table('toyotaprices')->paginate(13);
        $recordscount = DB::table('toyotaprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
