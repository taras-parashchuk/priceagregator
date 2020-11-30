<?php

namespace App\Imports;

use App\bmwprice;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class bmwimport implements ToCollection, WithChunkReading, WithBatchInserts
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row)
        {
            bmwprice::create([
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

