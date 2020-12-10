<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Request;
USE Session;
USE DB;

USE App\vagprice;
USE App\volvoprice;
USE App\toyotaprice;
USE App\psaprice;
USE App\gmprice;
USE App\bmwprice;
USE App\fiatprice;
USE App\daimlerprice;
USE App\hyundaiprice;
USE App\mazdaprice;
USE App\suzukiprice;
use App\File;

class UpdateRecord extends Controller
{
      public function update(Request $request)  //Апдейт одиночного запису (працює)
    {
        $brand = Session::get('brand');
        $Number=$request->input('Number');
        $Number2=$request->input('Number2');
        $Weight=$request->input('Weight');
        $VPE=$request->input('VPE');
        $VIN=$request->input('VIN');
        $NL=$request->input('NL');
        $Title=$request->input('Title');
        $Teileart=$request->input('Teileart');

        //$record = App\bmwprice::find(1);



            if ($brand == "VAG") {
                $record = vagprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);

            }
            if ($brand == "VOLVO") {
                $record = volvoprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "TOYOTA") {
                $record = toyotaprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "PSA") {
                $record = psaprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "GM") {
                $record = gmprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "BMW") {
                $record = bmwprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "FIAT") {
                $record = fiatprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "DAIMLER") {
                $record = daimlerprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "HYUNDAI") {
                $record = hyundaiprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "MAZDA") {
                $record = mazdaprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }
            if ($brand == "SUZUKI") {
                $record = suzukiprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2, 'WEIGHT' => $Weight, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $Title, 'TEILEART' => $Teileart]);
            }

         $record = 1;
         return back()->with('updated', $record);
    }


        public function updatemany(Request $request)
          {
              $brand = Session::get('brand');

          /*
              $request->validate([
                  'file' => 'required|mimes:csv',
              ]);
          */
              if($request->hasFile('fileupdates'))

              {
                  $storagepath = $request->file('fileupdates')->store('input');
                  $originalname = $request->file('fileupdates')->getClientOriginalName();  // оригинальное название файла
                  $fsize = $request->file('fileupdates')->getSize();

                    $inpfile = new File;
                    $inpfile->originalname = $originalname;
                    $inpfile->storagepath = $storagepath;
                    $inpfile->fsize = $fsize;
                    $inpfile->fsize = $fsize;
                    $inpfile->mission = "update";
                    $inpfile->brand = $brand;
                    $inpfile->save();

                  $contents = Storage::get($storagepath);
                  $linesarr = explode("\r\n",$contents); //розбиваємо по рядках
                  unset($contents);

                // Формуєм масив з ряків csv
                  $i=0;
                  $updated = 0;
                  foreach ($linesarr as $linesar)
                  {
                      if (!empty($linesar)) {
                          $csvarr[$i] = str_getcsv($linesar, ";",'"',"\\");

                                           }
                      $i++;
                  }
                 //  dd($csvarr);
                    $totalrec = count($csvarr);
                  reset($csvarr);

                   //Апдейтим записи в базі в циклі

                   //Перший рядок $csvarr пропускається , решта апдейтяться.

                  foreach ($csvarr as $arr)
                            {
                                if (isset($arr[0]))   { $NUMBER  =  $arr[0];} else {$NUMBER = " ";}
                                if (isset($arr[1]))   { $NUMBER2 =  $arr[1]; } else {$NUMBER2 = " ";}
                                if (isset($arr[2]))   { $WEIGHT =  $arr[2]; } else { $WEIGHT = " ";}
                                if (isset($arr[3]))   { $VPE =  $arr[3]; } else {$VPE = " ";}
                                if (isset($arr[4]))   { $VIN =  $arr[4]; } else {$VIN = " ";}
                                if (isset($arr[5]))   { $NL =  $arr[5]; } else { $NL = " ";}
                                if (isset($arr[6]))   { $TITLE =  $arr[6]; } else { $TITLE = " ";}
                                if (isset($arr[7]))   { $TEILEART =  $arr[7]; } else { $TEILEART = " ";}


                                $control =  $NUMBER." ". $NUMBER2." ". $WEIGHT." ". $VPE." ". $VIN." ". $NL." ". $TITLE." " .$TEILEART;
                               // dd($control);
                               // dd($csvarr);

                             $record = vagprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                             $updated = $updated + $record;
                             //  DB::table('vagprices')->where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2,'WEIGHT'=>$WEIGHT,'VPE'=>$VPE,'VIN'=>$VIN,'NL'=>$NL, 'TITLE'=>$TITLE,'TEILEART' =>$TEILEART]);

                            }
                  dd($updated);  // При кількості рядків 13 виводить 12, перший рядок в масиві не проапдейтило

                 } else  {
                    return "die";
                         }
              //$record = 96;
              //return view('layouts.layout')->with('updated', $record);
              //return back()->with(["updated"=>$updated,"total"=>$totalrec]);
              //return back()->with(["updated"=>$updated,"total"=>$totalrec]);
              return back()->with('updated', $updated);
          }


          //***********************************************************************************************************************************//
          /*
           *              if (isset($csvarr[$i][0]))   { $NUMBER  =  $csvarr[$i][0]; } else {$NUMBER = " ";}
                          if (isset($csvarr[$i][1]))   { $NUMBER2 =  $csvarr[$i][1]; } else {$NUMBER2 = " ";}
                          if (isset($csvarr[$i][2]))   { $WEIGHT =  $csvarr[$i][2]; } else { $WEIGHT = " ";}
                          if (isset($csvarr[$i][3]))   { $VPE =  $csvarr[$i][3]; } else {$VPE = " ";}
                          if (isset($csvarr[$i][4]))   { $VIN =  $csvarr[$i][4]; } else {$VIN = " ";}
                          if (isset($csvarr[$i][5]))   { $NL =  $csvarr[$i][5]; } else { $NL = " ";}
                          if (isset($csvarr[$i][6]))   { $TITLE =  $csvarr[$i][6]; } else { $TITLE = " ";}
                          if (isset($csvarr[$i][7]))   { $TEILEART =  $csvarr[$i][7]; } else { $TEILEART = " ";}
                          $control =  $NUMBER." ". $NUMBER2." ". $WEIGHT." ". $VPE." ". $VIN." ". $NL." ". $TITLE." " .$TITLE;
                           // dd($control);
                          if ($brand == "VAG") {
                              $record = vagprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                            //  $updated = $updated +$record ;
                          }
                          if ($brand == "VOLVO") {
                              $record = volvoprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                           //   $updated = $updated +$record ;
                          }
                          if ($brand == "TOYOTA") {
                              $record = toyotaprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                          }
                          if ($brand == "PSA") {
                              $record = psaprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                            //  $updated = $updated +$record ;
                          }
                          if ($brand == "GM") {
                              $record = gmprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                             // $updated = $updated +$record ;
                          }
                          if ($brand == "BMW") {
                              $record = bmwprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                            //  $updated = $updated +$record ;
                          }
                          if ($brand == "FIAT") {
                              $record = fiatprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                            //  $updated = $updated +$record ;
                          }
                          if ($brand == "DAIMLER") {
                              $record = daimlerprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                           //   $updated = $updated +$record ;
                          }
                          if ($brand == "HYUNDAI") {
                              $record = hyundaiprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                           //   $updated = $updated +$record ;
                          }
                          if ($brand == "MAZDA") {
                              $record = mazdaprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                           //   $updated = $updated +$record ;
                          }
                          if ($brand == "SUZUKI") {
                              $record = suzukiprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                           //   $updated = $updated +$record ;
                          }

                                 $i++;
           *
           *
           *   /*
                                if (isset($csvarr[$i][0]))   { $NUMBER  =  $csvarr[$i][0]; } else {$NUMBER = " ";}
                                if (isset($csvarr[$i][1]))   { $NUMBER2 =  $csvarr[$i][1]; } else {$NUMBER2 = " ";}
                                if (isset($csvarr[$i][2]))   { $WEIGHT =  $csvarr[$i][2]; } else { $WEIGHT = " ";}
                                if (isset($csvarr[$i][3]))   { $VPE =  $csvarr[$i][3]; } else {$VPE = " ";}
                                if (isset($csvarr[$i][4]))   { $VIN =  $csvarr[$i][4]; } else {$VIN = " ";}
                                if (isset($csvarr[$i][5]))   { $NL =  $csvarr[$i][5]; } else { $NL = " ";}
                                if (isset($csvarr[$i][6]))   { $TITLE =  $csvarr[$i][6]; } else { $TITLE = " ";}
                                if (isset($csvarr[$i][7]))   { $TEILEART =  $csvarr[$i][7]; } else { $TEILEART = " ";}
                                    */


}
