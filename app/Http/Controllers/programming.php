<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class programming extends Controller
{
    public function index() {

        $pricedata = array(array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0),
            array(1,2,3,4,5,6,7,8,9,0));

        $rownum = count($pricedata);

        if ( $rownum > 10 )  { $rownum ==10; }

     //   return view('layouts.array')->with(['newprice'=>compact($pricedata),'prcolnum'=>$colnum]);

         //   dd(count($pricedata));

        return view('layouts.array')->with(['pricedata'=>$pricedata,'rownum'=>$rownum]);

         }
}

/*




            @for ($i = 1; $i < 13; $i++)
                <tr>
                    @for ($y = 0; $y < $prcolnum; $y++)
                        <td>{{ $newprice[$i][$y] }}</td>
                    @endfor
                </tr>
            @endfor

  @foreach ($pricedata as $subArr)
                <tr>
                @foreach ($subArr as $elem)
                        <td>{{ $elem }}</td>
                @endforeach
                </tr>
            @endforeach



 */
