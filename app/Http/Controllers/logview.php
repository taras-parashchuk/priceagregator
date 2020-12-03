<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\log;
USE Session;

class logview extends Controller
{
    public function index(Request $request)
                                    {
            $brand = Session::get('brand');
            $logview = log::where('brand','=',$brand)->get();
            //dd($logview);
            return view('layouts.log')->with(['logs'=>$logview]);
                                    }

      public function clear(Request $request)
                                  {
              $brand = Session::get('brand');
              log::where('brand','=',$brand)->delete();
              $brand = Session::get('brand');
              $logview = log::where('brand','=',$brand)->get();
              return view('layouts.log')->with(['logs'=>$logview]);
                                  }

}
