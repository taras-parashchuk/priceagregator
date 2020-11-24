<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Facades\Hash;


class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
           'name'     => $row[0],
           'email'    => $row[1],
           'password' => Hash::make($row[2]),
        ]);
    }
}
