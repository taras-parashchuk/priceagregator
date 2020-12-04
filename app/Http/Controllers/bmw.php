<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class bmw extends Controller
{
    public function viewtwenty(Request $request)
           {
               $request->session()->put('brand', 'BMW');
               //SessionController@storeSessionData;
               $products = DB::table('bmwprices')->paginate(20);
               $recordscount = DB::table('bmwprices')->count();
            //  dd($request);
               return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

           }
}
