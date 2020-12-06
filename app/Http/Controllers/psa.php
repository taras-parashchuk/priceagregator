<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class psa extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'PSA');
        //SessionController@storeSessionData;
        $products = DB::table('psaprices')->paginate(19);
        $recordscount = DB::table('psaprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
