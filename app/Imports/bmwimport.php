<?php

namespace App\Imports;

use App\bmwprice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\SRC\Concerns\WithBatchInserts;
use Maatwebsite\Excel\SRC\Concerns\WithChunkReading;

class bmwimport implements ToModel
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
{
    public function model(array $row)
    {
        return new bmwprice([
            'NUMBER' => $row[0],
            'NUMBER2' => $row[1],
            'WEIGHT' => $row[2],
            'VPE' =>     $row[3],
            'VIN' =>     $row[4],
            'NL' =>      $row[5],
            'TITLE' =>   $row[6],
            'TEILEART'=> $row[7],

        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }


    public function uniqueBy()
    {
        return 'NUMBER';
    }
}

