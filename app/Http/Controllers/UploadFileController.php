<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use League\Csv\Reader;
use Session;
use Illuminate\Support\Facades\Cache;


class UploadFileController extends Controller
{
    public function fileUploadPost(Request $request) {

        $rownum = 0;
        $pricedata = array();

        $request->validate([
            'file' => 'required|mimes:txt,csv',
        ]);
        $brand = Session::get('brand');

        if($request->hasFile('file'))
            {
                $storagepath = $request->file('file')->store('input');
                $originalname = $request->file('file')->getClientOriginalName();  // оригинальное название файла
                $fsize = $request->file('file')->getSize();

                $inpfile = new File;
                $inpfile->originalname = $originalname;
                $inpfile->storagepath = $storagepath;
                $inpfile->fsize = $fsize;
                $inpfile->mission = "price";
                $inpfile->brand = $brand;
                $inpfile->save();

                $contents = Storage::get($storagepath);
                $reader = Reader::createFromString($contents);
                $reader->setDelimiter(';');
                $records = $reader->getRecords();

                foreach ($records as $row) {
                    $pricedata[] = $row;
                   }
                $rownum = count($pricedata);
            }
            // dd($pricedata);

      /*  $pricedata = array(
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0));

*/


        if ( $rownum > 10 )  { $rownum ==10; }

        //   return view('layouts.array')->with(['newprice'=>compact($pricedata),'prcolnum'=>$colnum]);

        //   dd(count($pricedata));

       // return view('layouts.layout')->with(['pricedata'=>$pricedata,'rownum'=>$rownum]);
        return view('layouts.layout')->with(['pricedata'=>$pricedata,'rownum'=>$rownum]);

    }
}
