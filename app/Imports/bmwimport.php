<?php

namespace App\Imports;

use App\bmwprice;
use Maatwebsite\Excel\Concerns\ToModel;

class bmwimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new bmwprice([
            //
        ]);
    }
}
