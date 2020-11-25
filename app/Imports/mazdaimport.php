<?php

namespace App\Imports;

use App\mazdaprice;
use Maatwebsite\Excel\Concerns\ToModel;

class mazdaimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new mazdaprice([
            //
        ]);
    }
}
