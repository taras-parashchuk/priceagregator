<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class databasestatus extends Controller
{
    public function index(Request $request) {

        $brand = $request->input('brand');

        if ($brand == "VAG")     {$tableprice = 'vagprices';     }
        if ($brand == "BMW")     {$tableprice = 'bmwprices';     }
        if ($brand == "DAIMLER") {$tableprice= 'daimlerprices';  }
        if ($brand == "FIAT")    {$tableprice = 'fiatprices';    }
        if ($brand == "GM")      {$tableprice = 'gmprices';      }
        if ($brand == "HYUNDAI") {$tableprice = 'hyundaiprices'; }
        if ($brand == "MAZDA")   {$tableprice = 'mazdaprices';   }
        if ($brand == "PSA")     {$tableprice = 'psaprices';     }
        if ($brand == "SUZUKI")  {$tableprice = 'suzukiprices';  }
        if ($brand == "TOYOTA")  {$tableprice = 'toyotaprices';  }
        if ($brand == "VOLVO")   {$tableprice = 'volvoprices' ;  }

        $blocked = Cache::get($tableprice);
        if ($blocked == null ) { $blocked = 0; }
        $status  = Cache::get($tableprice."action");
        if ($status == null) { $status = "";}



        return response()->json(array('blocked'=> $blocked,'status'=>$status), 200);
    }
}
