<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
USE Session;
use Storage;


class fileview extends Controller
{
    public function index(Request $request)
                 {
                $links = array();
                $brand = Session::get('brand');
                $fileview = file::where('brand','=',$brand)->get();

                foreach ($fileview as $file)
                     {
                       $file->storagepath;
                       $links[] =  asset($file->storagepath);
                     }
              //  dd($links);
                return view('layouts.files')->with(['files'=>$fileview,"links"=>$links]);
                  }
}
