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
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

class downloadDatabase extends Controller
{
    public function index(Request $request)
    {


        $csv = Writer::createFromFileObject(new \SplTempFileObject);
        $csv->setDelimiter(";");
        $brand = Session::get('brand');

        if ($brand == "VAG")      {$tableprice = 'vagprices';     }
        if ($brand == "BMW")      {$tableprice = 'bmwprices';     }
        if ($brand == "DAIMLER")  {$tableprice= 'daimlerprices';  }
        if ($brand == "FIAT")     {$tableprice = 'fiatprices';    }
        if ($brand == "GM")       {$tableprice = 'gmprices';      }
        if ($brand == "HYUNDAI")  {$tableprice = 'hyundaiprices'; }
        if ($brand == "MAZDA")    {$tableprice = 'mazdaprices';   }
        if ($brand == "PSA")      {$tableprice = 'psaprices';     }
        if ($brand == "SUZUKI")   {$tableprice = 'suzukiprices';  }
        if ($brand == "TOYOTA")   {$tableprice = 'toyotaprices';  }
        if ($brand == "VOLVO")    {$tableprice = 'volvoprices' ;  }

        $blocked = Cache::store('database')->get($tableprice);
        if ($blocked == null) {
            $blocked = Cache::store('database')->put($tableprice,"1");
            Cache::store('database')->put($tableprice."action","Downloading");

            $fname = "base-" . $brand . "-" . date("H:i:s Y-m-d") . ".csv";
            $filename = 'attachment; filename ="' . $fname . '"';


            if ($brand == "VAG") {
                $records = vagprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
            }
            if ($brand == "VOLVO") {
                $records = volvoprice::All('NUMBER', 'NUMBER2', 'WEIGHT', 'VPE', 'VIN', 'NL', 'TITLE', 'TEILEART')->toArray();
                $csvcount = $csv->insertAll($records);
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
        Cache::store('database')->pull($tableprice);
        Cache::store('database')->pull($tableprice."action");
        }
        return response((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => $filename,
        ]);
    }
}
