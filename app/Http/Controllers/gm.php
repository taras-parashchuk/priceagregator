<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class gm extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'GM');
        //SessionController@storeSessionData;
        $products = DB::table('gmprices')->paginate(20);
        $recordscount = DB::table('gmprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
