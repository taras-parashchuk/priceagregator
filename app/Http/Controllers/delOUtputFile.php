<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\File;
use App\log;


class delOUtputFile extends Controller
{
    public function index(Request $request)
    {
        $msg = "This is a simple message.";
        //return response()->json(array('msg' => $msg), 200);
        $brand = $request->brand;

        $files = file::where('brand','=',$brand)->where('mission','=','download')->get();


        $deletelist = array();


        // dd($deleted);
        foreach ($files as $file)
        {
            $deletelist[] = $file->storagepath;
        }
        $deleted = count($deletelist);


        $files = file::where('brand','=',$brand)->delete();

        Storage::delete($deletelist);

        if ($deleted > 0)
        {
            $status  = "success";
            $message = " Deleted". $deleted." output files ";

        } else {
            $status  = "error";
            $message = " No files found in the output folder";
        }

        $logg = new log;
        $logg->brand   = $brand;
        $logg->status  = $status;
        $logg->action  = "delete";
        $logg->message = $message;
        $logg->save();

        return  back()->with(['deleted'=>$deleted]);
    }

}
