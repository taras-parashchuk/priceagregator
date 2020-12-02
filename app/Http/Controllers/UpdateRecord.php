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
USE App\table;

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

             if ($record > 0) { $errors = 0; } else { $errors = 1;}
         return back()->with(['updated'=> $record,'refused'=>$errors]);
                      }


        public function updatemany(Request $request)
          {
              $brand = Session::get('brand');
              $errmsg =array();
              $refused =0;

         if($request->hasFile('fileupdates'))

              {
                  $storagepath = $request->file('fileupdates')->store('input');
                  $originalname = $request->file('fileupdates')->getClientOriginalName();  // оригинальное название файла
                  $fsize = $request->file('fileupdates')->getSize();

                    $inpfile = new File;
                    $inpfile->originalname = $originalname;
                    $inpfile->storagepath = $storagepath;
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

                  $totalrec = count($csvarr);

                //  $id = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $id);
                //  $id =  preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', '', $id);


                  reset($csvarr);
                  if ($brand == "VAG") {$tableprice = 'vagprices'; }
                  if ($brand == "BMW") {$tableprice = 'bmwprices'; }
                  if ($brand == "DAIMLER") { $tableprice= 'daimlerprices';  }
                  if ($brand == "FIAT") { $tableprice = 'fiatprices'; }
                  if ($brand == "GM") { $tableprice = 'gmprices'; }
                  if ($brand == "HYUNDAI") { $tableprice = 'hyundaiprices'; }
                  if ($brand == "MAZDA") { $tableprice = 'mazdaprices';  }
                  if ($brand == "PSA") {$tableprice = 'psaprices';  }
                  if ($brand == "SUZUKI") {$tableprice = 'suzukiprices';  }
                  if ($brand == "TOYOTA") {$tableprice = 'toyotaprices'; }
                  if ($brand == "VOLVO") {$tableprice = 'volvoprices' ; }

            //  dd($table);

                    // Блокуємо таблиці
                  $block = table::find($tableprice);
                  $blocked = $block->status;

                  if ($blocked == 0) {

                      $block->status = 1;  //Ставимо блок на таблицю
                      $block->save();
                      $updated = 0;
                      $errors = 0;

                      // Пишемо рядки в базу
                      foreach ($csvarr as $arr) {
                          if (isset($arr[0])) {$NUMBER = $arr[0]; } else { $NUMBER = " "; }
                          if (isset($arr[1])) {$NUMBER2 = $arr[1];} else { $NUMBER2 = " ";}
                          if (isset($arr[2])) {$WEIGHT = $arr[2]; } else { $WEIGHT = " "; }
                          if (isset($arr[3])) {$VPE = $arr[3];    } else {  $VPE = " ";   }
                          if (isset($arr[4])) {$VIN = $arr[4];    } else { $VIN = " ";    }
                          if (isset($arr[5])) {$NL = $arr[5];     } else { $NL = " ";     }
                          if (isset($arr[6])) {$TITLE = $arr[6];  } else { $TITLE = " ";  }
                          if (isset($arr[7])) {$TEILEART = $arr[7];} else {$TEILEART = " ";}

                          $NUMBER = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $NUMBER);
                          $NUMBER = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', '', $NUMBER);

                          $NUMBER2 = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $NUMBER2);
                          $WEIGHT = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $WEIGHT);
                          $VPE = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $VPE);
                          $VIN = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $VIN);
                          $NL = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $NL);
                          $TITLE = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $TITLE);
                          $TEILEART = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $TEILEART);

                          /*
                          $reсord = vagprice::find($NUMBER);
                          $reсord->NUMBER2 = $NUMBER2;
                          $reсord->WEIGHT  = $WEIGHT;
                          $reсord->VPE     = $VPE;
                          $reсord->VIN     = $VIN;
                          $reсord->NL      = $NL;
                          $reсord->TITLE   = $TITLE;
                          $reсord->TEILEART= $TEILEART;
                          $reсord->save();
                         */


                          //$brand = 'VAG';

                          if ($brand == "VAG") {

                              $record = vagprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found';
                              }
                          }
                          if ($brand == "VOLVO") {
                              $record = volvoprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "TOYOTA") {
                              $record = toyotaprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "PSA") {
                              $record = psaprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "GM") {
                              $record = gmprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "BMW") {
                              $record = bmwprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "FIAT") {
                              $record = fiatprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "DAIMLER") {
                              $record = daimlerprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "HYUNDAI") {
                              $record = hyundaiprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "MAZDA") {
                              $record = mazdaprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                          if ($brand == "SUZUKI") {
                              $record = suzukiprice::where('NUMBER', $NUMBER)->update(['NUMBER2' => $NUMBER2, 'WEIGHT' => $WEIGHT, 'VPE' => $VPE, 'VIN' => $VIN, 'NL' => $NL, 'TITLE' => $TITLE, 'TEILEART' => $TEILEART]);
                              $updated = $updated + $record;
                              if ($record == 0) {
                                  $refused++;
                                  $errmsg[]=strval($NUMBER) . ' not found' ;
                              }
                          }
                      }
                  }
                  $block->status = 0;  // Знімаємо блок з таблиці
                  $block->save();
              } else  {
                    return  back()->with('errors',"No file uploaded");
                         }

              return back()->with(['updated'=> $updated,'total'=> $totalrec,'refused'=> $refused ]);
          }


}
