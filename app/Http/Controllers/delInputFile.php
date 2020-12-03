<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;


use App\File;



class delInputFile extends Controller
{
    public function index(Request $request)
    {
        $msg = "This is a simple message.";
        //return response()->json(array('msg' => $msg), 200);
        $brand = $request->brand;

        $files = file::where('brand','=',$brand)->where('mission','=','update')->get();


        $deletelist = array();


         // dd($deleted);
        foreach ($files as $file)
                {
                 $deletelist[] = $file->storagepath;
                }
        $deleted = count($deletelist);


        $files = file::where('brand','=',$brand)->delete();

        Storage::delete($deletelist);


        return  back()->with(['deleted'=>$deleted]);
    }
}
