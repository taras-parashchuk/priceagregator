<?php

namespace App\Imports;

use App\gmprice;
use Maatwebsite\Excel\Concerns\ToModel;

class gmimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new gmprice([
            //
        ]);
    }
}
