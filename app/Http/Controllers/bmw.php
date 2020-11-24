<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class bmw extends Controller
{
    public function viewtwenty(Request $request)
           {
               $request->session()->put('brand', 'bmw');
              // DB::table('bmw-temps')->insert($arrayy);
               //DB::table('bmw-temps')->all()->take(20)->get();
               //$goods = DB::select('select * from bmw-temps where 1=1', [1]);

               $products = DB::table('bmw-temps')->paginate(13);
               $recordscount = DB::table('bmw-temps')->count();
               return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);
              // return view('layouts.layout', ['count' => $count]);

           }
}
