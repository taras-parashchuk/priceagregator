<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vag extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'VAG');
        $products = DB::table('vagprices')->paginate(13);
        $recordscount = DB::table('vagprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }


}
