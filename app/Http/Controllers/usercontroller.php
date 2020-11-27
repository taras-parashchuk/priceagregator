<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;




class usercontroller extends Controller
{
     public function import()
    {
        //Excel::import(new UserImport, 'users.xlsx');
        $array = Excel::toArray(new UserImport, storage_path('/app/public/users.xlsx'));
        dd($array);



        return redirect('/')->with('usersuploaded', 'All good!');
    }
}
