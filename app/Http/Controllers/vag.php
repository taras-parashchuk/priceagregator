<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class vag extends Controller
{
    public function viewtwenty(Request $request)
    {
        $tableprice = 'vagprices';
        Cache::pull($tableprice);
        Cache::pull($tableprice);

        $request->session()->put('brand', 'VAG');
        $products = DB::table('vagprices')->paginate(19);
        $recordscount = DB::table('vagprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);

    }


}
