<?php

namespace App\Imports;

use App\suzukiprice;
use Maatwebsite\Excel\Concerns\ToModel;

class suzukiimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new suzukiprice([
            //
        ]);
    }
}
