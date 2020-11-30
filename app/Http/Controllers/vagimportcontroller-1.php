<?php

namespace App\Http\Controllers;
use App\Imports\vagimport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class vagimportcontroller extends Controller
{

    public function import()
    {
        $time1 = time();
        $result =   Excel::import(new vagimport, storage_path('/app/public/vag102020.csv'));
        dd($result);
        $time2 = time();
        $spent =$time2 - $time1;
        return view('layouts.layout')->with('updated', $records);
    }
}
