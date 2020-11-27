<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE Session;
USE DB;
USE App\bmwprice;


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
        $record = bmwprice::where('NUMBER', $Number)->update(['NUMBER2' => $Number2,'WEIGHT'=>$Weight,'VPE'=>$VPE,'VIN'=>$VIN,'NL'=>$NL,'TITLE'=>$Title,'TEILEART'=>$Teileart]);


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
              $record = 96;
              return view('layouts.layout')->with('updated', $record);

          }


}
