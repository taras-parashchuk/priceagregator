<?php

namespace App\Http\Controllers;


//use App\lain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
         //BMW controller

        $request->validate([
            'file' => 'required|mimes:txt,csv',
        ]);

        //$ext = time().'.'.$request->file->extension();

        $fname = $request->file->getClientOriginalName();
        $fileName = date("H-i")."_".date("d-m-Y")."_".$fname;


      // dd($contents);
        /*
         date("H-i")_date("d-m-Y")
         date("d.m.Y")
         */

        $path = $request->file->store('input');
        $contents = Storage::get($path);
       // explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] ) : array
        $linesarr = explode("\r\n",$contents);

        $contents='';
        unset($contents);


              $i=0;

              $max_arrayy = 0;
            $time1 = time();
        foreach($linesarr as $line)
            {

                $NUMBER=substr($line,0,11);
                $price=floatval(substr($line,12,11));
                $zalog=floatval(substr($line,35,2));;
                $rg=floatval(substr($line,57,1));
                $zakup=floatval(substr($line,69,12));
                $i++;
                $arrayy[$i] = compact('NUMBER',$NUMBER);

                if ($max_arrayy>=10000)
                    {
                        $brand = Session::get('brand');
                       if ($brand == 'BMW')
                       {
                           DB::table('bmwprices')->insert($arrayy);

                        }
                        $max_arrayy == 0;

                     //unset($arrayy);
                       $arrayy =  array();
                    }
                $max_arrayy++;

           //     DB::table('bmw-temps')->insert(
           //         ['kod' => $kod, 'price' => $price,'zalog'=>$zalog,'rg'=>$rg,'zakup'=>$zakup]
                //   );



            }
        DB::table('bmwprices')->insert($arrayy);
        //  dd($arrayy);
        $time2 = time();
        $timespent = $time2 - $time1;

        unset($arrayy);
        unset($linesarr);




       //    DB::table('bmw-temps')->insert($arrayy);
        $path = public_path('');
       //  $request->file->move(public_path('uploads'), $fileName);

       //   dd($path);

        $fullname = $fileName;
          // dd($request);
        return back()
            ->with('success','Вы успешно загрузили файл.')
            ->with('timespent',$timespent);
          //  ->with('content',)

    }
}
