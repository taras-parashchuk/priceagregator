<?php

namespace App\Http\Controllers;


//use App\lain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;

class vagimportcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {

        $time1 = time();

        $contents = Storage::get("/public/vag10k.csv");
        // explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] ) : array
        $linesarr = explode("\r\n",$contents);

        unset($contents);
        // dd($linesarr);

        foreach ($linesarr as $linesar)
        {
               if (!empty($linesar)) {
               $csvarr[] = str_getcsv($linesar, ";",'"',"\\");

               if (isset($csvarr[0]))   { $NUMBER  =  $csvarr[0]; } else {$NUMBER = " ";}
                if (isset($csvarr[3]))   { $NUMBER2 =  $csvarr[3]; } else {$NUMBER2 = " ";}
               if (isset($csvarr[5]))   { $WEIGHT =  $csvarr[5]; } else { $WEIGHT = " ";}
                if (isset($csvarr[1]))   { $VPE =  $csvarr[1]; } else {$VPE = " ";}
                if (isset($csvarr[2]))   { $NL =  $csvarr[2]; } else { $NL = " ";}
                if (isset($csvarr[7]))   { $TITLE =  $csvarr[7]; } else { $TITLE = " ";}
                if (isset($csvarr[6]))   { $TEILEART =  $csvarr[6]; } else { $TEILEART = " ";}

                $VIN     = "1";

         //$aa[] = compact('NUMBER','NUMBER2','WEIGHT','VPE','VIN','NL','TITLE','TEILEART',$NUMBER,$NUMBER2,$WEIGHT,$VPE,$VIN,$NL,$TITLE,$TEILEART);
            }
        }

            // dd($aa);


       // dd($diff);

        //var_dump($csvarr);
        //dd($csvarr);
        //$contents='';




        foreach($csvarr as $array)
                        {
                            $NUMBER  =  $array[0];
                            $NUMBER2 =  $array[3];
                            $WEIGHT  =  $array[5];
                            $VPE     =  $array[1];
                            $VIN     = "1";
                            $NL      =  $array[2];
                            $TITLE   =  $array[7];
                            $TEILEART=  $array[6];

                            $aa[] = compact('NUMBER','NUMBER2','WEIGHT','VPE','VIN','NL','TITLE','TEILEART',$NUMBER,$NUMBER2,$WEIGHT,$VPE,$VIN,$NL,$TITLE,$TEILEART);

                        }

       //   DB::table('vagprices')->insert($aa);
           // dd($aa);

          // Kill  duplicates



     //   $aa = array_unique($aa,SORT_REGULAR);

      //  $bb = $this->array_unique_key($aa,'NUMBER');
     //   dd(count($bb));

        $qu = array_column($aa, null, 'NUMBER');
        dd($qu);

        $aa = array_values(array_column($aa, null, 'NUMBER'));



       // $diff=$time2-$time1;
       // dd($aa);


        foreach($aa as $arr )
          {
              DB::table('vagprices')->insert($arr);
          }

        $time2 = time();
        $diff=$time2-$time1;
       dd($diff);
     //   dd($res);

/*
        $i=0;
             foreach($aa as $array)
                  {
                   $current = $array[$i]['NUMBER'];
                   for ( $ii = $i+1; $i < (count($aa)-1);$ii = $ii+1)
                          {

                        if($current == $array[$ii]['NUMBER'])
                             {
                           unset($array[$ii]);
                           ++$deleted;
                             }
                          }
                       $i++;
                   }
            */


        //unset($aa[0]);
        dd($aa);

        /*
        $cc1 = count($aa);

        $bb = $this->array_unique_key($aa,"NUMBER");
        $cc2 = count($bb);
        $diff =  $cc1 -  $cc2;
        dd($diff);
*/


          // $out = $NUMBER." ".$NUMBER2." ".$WEIGHT." ".$VPE." ".$VIN." ".$NL." ".$TITLE." ".$TEILEART;

        //DB::table('vagprices')->insert(compact($NUMBER,$NUMBER2,$WEIGHT,$VPE,$VIN,$NL,$TITLE,$TEILEART));
        //compact($NUMBER,$NUMBER2,$WEIGHT,$VPE,$VIN,$NL,$TITLE,$TEILEART);
          // dd($out);

        unset($linesarr);
        unset($csvarr);

      // $proba = $csvarr[3][0]." ".$csvarr[3][1]." ".$csvarr[3][2]." ".$csvarr[3][3]." ".$csvarr[3][4]." ".$csvarr[3][5]." ".$csvarr[3][6]." ".$csvarr[3][7];
      //  dd($proba);


       // dd($csvarr);
       // NUMBER	NUMBER2	WEIGHT	VPE	VIN	NL	TITLE	TEILEART
       /*
        $NUMBER  =  $csvarr[16][0];
        $NUMBER2 =  $csvarr[16][3];
        $WEIGHT  =  $csvarr[16][5];
        $VPE     =  $csvarr[16][1];
        $VIN     = "1";
        $NL      =  $csvarr[16][2];
        $TITLE   =  $csvarr[16][7];
        $TEILEART=  $csvarr[16][6];
        */

          // dd(count($csvarr));
     //   $arrayy[$i] = compact('NUMBER','NUMBER2','WEIGHT','VPE','VIN','NL','TITLE','TEILEART',$NUMBER,$NUMBER2,$WEIGHT,$VPE,$VIN,$NL,$TITLE,$TEILEART);
     //   DB::table('vagprices')->insert($arrayy);

        $max_arrayy = 0;
        $i=0;


     //  DB::table('vagprices')->insert($arrayy);


    }

  public  function array_unique_key($array, $key) {
        $tmp = $key_array = array();
        $i = 0;

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $tmp[$i] = $val;
            }
            $i++;
        }
        return $tmp;
    }

}
