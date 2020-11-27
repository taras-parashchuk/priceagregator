<?php

namespace App\Http\Controllers;
use App\Imports\bmwimport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class bmwimportcontroller extends Controller

{
    public function import()
    {
      // $array = Excel::toArray(new bmwimport, storage_path('/app/public/sample-import.xlsx'));

      $records =   Excel::toArray(new bmwimport, storage_path('/app/public/a_volv.xlsx'));
      dd($records);
        return view('layouts.layout')->with('updated', $records);
    }
}


