<?php

namespace App\Imports;

use App\vagprice;
use Maatwebsite\Excel\Concerns\ToModel;

class vagimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new vagprice([
            //
        ]);
    }
}
