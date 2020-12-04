<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class volvo extends Controller
{
    public function viewtwenty(Request $request)
    {
        $request->session()->put('brand', 'VOLVO');
        $products = DB::table('volvoprices')->paginate(20);
        $recordscount = DB::table('volvoprices')->count();
        return view('layouts.layout', ['products' => $products,'kol' => $recordscount]);
    }
}
