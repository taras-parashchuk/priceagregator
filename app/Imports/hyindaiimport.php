<?php

namespace App\Imports;

use App\hyindaiprice;
use Maatwebsite\Excel\Concerns\ToModel;

class hyindaiimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new hyindaiprice([
            //
        ]);
    }
}
