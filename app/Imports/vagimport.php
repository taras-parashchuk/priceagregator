<?php

namespace App\Imports;

use App\vagprice;
//use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


//class vagimport implements ToModel, WithChunkReading, WithBatchInserts, WithCustomCsvSettings
class vagimport implements ToCollection, WithChunkReading, WithBatchInserts, WithCustomCsvSettings


{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    //public function model(array $row)

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            vagprice::create([
                'Number' => $row[0],
            ]);
        }
    }

 public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
	    'delimiter'  =>  ';'
        ];
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
