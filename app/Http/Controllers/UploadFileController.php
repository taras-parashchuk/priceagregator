<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use League\Csv\Reader;
use League\Csv\Statement;
use Session;
use Illuminate\Support\Facades\Cache;
use App\log;

class UploadFileController extends Controller
{
    //
    // a_Volv  ----          ---  VOLVO
    // etk_072020 --- Price.1  ---  BMW !!
    //
    //

    public function fileUploadPost(Request $request) {

        $rownum = 0;
        $connt = 0;
        $pricedata = array();
        $firstrow = array();

        //$ftype = $request->input('ftype');

        //dd($ftype);
       // dd($ftype);

        $request->validate([
            'file' => 'required|mimes:txt,csv',
        ]);
        $brand = Session::get('brand');

        if ($brand == "VAG")     {$tableprice = 'vagprices';     }
        if ($brand == "BMW")     {$tableprice = 'bmwprices';     }
        if ($brand == "DAIMLER") {$tableprice= 'daimlerprices';  }
        if ($brand == "FIAT")    {$tableprice = 'fiatprices';    }
        if ($brand == "GM")      {$tableprice = 'gmprices';      }
        if ($brand == "HYUNDAI") {$tableprice = 'hyundaiprices'; }
        if ($brand == "MAZDA")   {$tableprice = 'mazdaprices';   }
        if ($brand == "PSA")     {$tableprice = 'psaprices';     }
        if ($brand == "SUZUKI")  {$tableprice = 'suzukiprices';  }
        if ($brand == "TOYOTA")  {$tableprice = 'toyotaprices';  }
        if ($brand == "VOLVO")   {$tableprice = 'volvoprices' ;  }




         $ftype = $request->input('ftype');
         Cache::store('database')->put('filetype',$ftype);





        if($request->hasFile('file')) {

            $storagepath = $request->file('file')->store('input');
            $originalname = $request->file('file')->getClientOriginalName();  // оригинальное название файла

           // Cache::store("database")->put('originalname',$originalname);
            $fsize = $request->file('file')->getSize();

            $inpfile = new File;
            $inpfile->originalname = $originalname;
            $inpfile->storagepath  = $storagepath;
            $inpfile->fsize = $fsize;
            $inpfile->ftype = $ftype;

            $inpfile->mission = "price";
            $inpfile->brand = $brand;
            $inpfile->save();

          // works

            $contents = Storage::get($storagepath);
            //works
                    if ($ftype == "CSV")   {
                    // CSV reader begins
                        Cache::store('database')->put('work',"CSV reader begins");
                        $reader = Reader::createFromString($contents);
                    $reader->setDelimiter(';');
                    $records = Statement::create()->process($reader);

                    $connt = count($records); //return the total number of records found

                    $firstrow[0] = $records->fetchOne(0);

                    $colscount = count($firstrow[0]); // Тільки для CSV



                        if ($colscount < 2)     //Якщо стовбців в файлі менше 2 то пишем помилку в лог і припиняєм обробку;
                                {
                                    $logg = new log;
                                    $logg->brand  =  $brand;
                                    $logg->action =  'price';
                                    $logg->status =  'error';
                                    $logg->number =   "";
                                    $logg->message = 'File must contain more than 2 columns';
                                    $logg->save();
                                }  else {    // обробка

                        if ($connt > 19) { $connt = 19; }

                                    for ($i = 0; $i < $connt; $i++) {
                                        //$pricedata[] = $records;
                                        $pricedata[] = $records->fetchOne($i);
                                    }
                                    Cache::store('database')->put($tableprice . "price", $pricedata);
                                }
                      //  Cache::store('database')->put('work',"csv starting");
                    //CSV reader ends
                            } else {
                                     if (($ftype =="TXT") && ($brand == "BMW")) {
                                        // TXT reader begin
                                        Cache::store('database')->put('work',"bmw starting");
                                        // BMV text price reading
                                        // columns in text file
                                        // 0 - 10  11 -22   23 - 36    56 -57   65 - 77
                                        // 1       2        3          4        5
                                      $linesarr = explode("\r\n",$contents);
                                      $connt = count($linesarr);

                                        if ($connt > 19) { $connt = 19; }

                                        unset($contents);  // Звільняємо память

                                                        for ($i=0; $i<19; $i++)       {
                                                                $NUM1 = substr($linesarr[$i], 0,11 );
                                                                $NUM2 = substr($linesarr[$i],11,12);
                                                                $NUM3 = substr($linesarr[$i],23,14);
                                                                $NUM4 = substr($linesarr[$i],56,2);
                                                                $NUM5 = substr($linesarr[$i],65,13);

                                                                $NUM2 =  (string)floatval($NUM2);
                                                                $NUM3 =  (string)floatval($NUM3);
                                                                $NUM5 =  (string)floatval($NUM5);

                                                                $pricedata[$i] = array($NUM1,$NUM2,$NUM3,$NUM4,$NUM5);
                                                                                    }

                                Cache::store('database')->put($tableprice . "price", $pricedata);

                                // TXT reader ends
                                                                     }
                           }
        //return "Something uploaded";

        }  // End if has file

    }
}
