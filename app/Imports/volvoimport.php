<?php

namespace App\Imports;

use App\volvoprice;
use Maatwebsite\Excel\Concerns\ToModel;

class volvoimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new volvoprice([
            //
        ]);
    }
}
