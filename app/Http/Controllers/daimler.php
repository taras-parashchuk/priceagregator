<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class daimler extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'DAIMLER');
        //SessionController@storeSessionData;
        $products = DB::table('daimlerprices')->paginate(20);
        $recordscount = DB::table('daimlerprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
