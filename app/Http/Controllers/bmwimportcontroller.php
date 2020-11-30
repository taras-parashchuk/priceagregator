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

        //$result =   Excel::toArray(new bmwimport, storage_path('/app/public/INLAND.xlsx'));
      $result = Excel::import(new bmwimport,  storage_path('/app/public/INLAND.xlsx'));
      $records = count($result);
      return view('layouts.layout')->with('updated', $records);

    }
}


