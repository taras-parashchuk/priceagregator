<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


class UpdateRecord extends Controller
{
      public function update(Request $request)
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

        //dd($record);
        //Session::put('updated',$record);
        // $request->Session()->put('updated', $record);
         $request->session()->flash('updated', $record);
        //$data = $request->session()->all();
        //dd($data);
         return back()->with('updated', $record);
    }


        public function updatemany(Request $request)
          {
              $brand = Session::get('brand');
              //dd($request);

              if($request->hasFile('fileupdates'))

              {
                  $name = $request->input('fileupdates');
                  return "Hello file";
              } else {
                  return "die";
              }
              //$record = 96;
              //return view('layouts.layout')->with('updated', $record);
              return "Hello";
          }


}
