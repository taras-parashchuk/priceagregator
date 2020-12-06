<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class suzuki extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'SUZUKI');
        //SessionController@storeSessionData;
        $products = DB::table('suzukiprices')->paginate(19);
        $recordscount = DB::table('suzukiprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }
}
