<?php

namespace App\Imports;

use App\toyotaprice;
use Maatwebsite\Excel\Concerns\ToModel;

class toyotaimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new toyotaprice([
            //
        ]);
    }
}
