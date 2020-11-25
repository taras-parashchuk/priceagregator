<?php

namespace App\Imports;

use App\fiatprice;
use Maatwebsite\Excel\Concerns\ToModel;

class fiatimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new fiatprice([
            //
        ]);
    }
}
