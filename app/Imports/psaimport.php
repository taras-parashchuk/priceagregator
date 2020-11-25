<?php

namespace App\Imports;

use App\psaprice;
use Maatwebsite\Excel\Concerns\ToModel;

class psaimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new psaprice([
            //
        ]);
    }
}
