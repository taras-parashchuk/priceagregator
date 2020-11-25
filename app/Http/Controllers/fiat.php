<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class fiat extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'FIAT');
        //SessionController@storeSessionData;
        $products = DB::table('fiatprices')->paginate(13);
        $recordscount = DB::table('fiatprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
