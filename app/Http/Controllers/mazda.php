<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mazda extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'MAZDA');
        //SessionController@storeSessionData;
        $products = DB::table('mazdaprices')->paginate(20);
        $recordscount = DB::table('mazdaprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
