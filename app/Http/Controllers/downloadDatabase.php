<?php

namespace App\Http\Controllers;
use App\bmwprice;
use App\daimlerprice;
use App\fiatprice;
use App\gmprice;
use App\hyundaiprice;
use App\mazdaprice;
use App\psaprice;
use App\suzukiprice;
use App\toyotaprice;
use App\vagprice;
use App\volvoprice;
use Session;
use Storage;
use League\Csv\Writer;

use Illuminate\Http\Request;

class downloadDatabase extends Controller
{
    public function index(Request $request)
    {
        

        $csv = Writer::createFromFileObject(new \SplTempFileObject);
        $csv->setDelimiter(";");
        $brand = Session::get('brand');

        $fname = "base-".$brand."-".date("H:i:s Y-m-d").".csv";
        $filename = 'attachment; filename ="'.$fname.'"';


            if ($brand == "VAG") {
               $records = vagprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
               $csvcount = $csv->insertAll($records);
               $csv->output('people.csv');
               }
            if ($brand == "VOLVO") {
               $records = volvoprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
               $csvcount = $csv->insertAll($records);
               $csv->output('people.csv');
               }
            if ($brand == "TOYOTA") {

                $records = toyotaprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "PSA") {
                $records = psaprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "GM") {
                $records = gmprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "BMW") {
                $records = bmwprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "FIAT") {
                $records = fiatprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "DAIMLER") {
                $records = daimlerprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "HYUNDAI") {
                $records = hyundaiprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "MAZDA") {
                $records = mazdaprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "SUZUKI") {
                $records = suzukiprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }

        return response((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => $filename,
        ]);
    }
}
