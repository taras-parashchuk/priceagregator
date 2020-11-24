<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
      // pathInfo


    public function accessSessionData(Request $request) {
        if($request->session()->has('my_name'))
            echo $request->session()->get('my_name');
        else
            echo 'No data in the session';
    }

    public function storeSessionData(Request $request) {

        $brand = $request->path();
        dd($brand);
        $request->session()->put('brand',$brand);
        $request->session()->save();
        dd($request->session()->get('brand'));
    }

}
