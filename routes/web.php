<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', function (Request $request) {

    $brand = $request->session()->get('brand');

    if ($brand == "BMW")    { return redirect('/bmw');     }
    if ($brand == "VAG")    { return redirect('/vag');     }
    if ($brand == "VOLVO")  { return redirect('/volvo');   }
    if ($brand == "daimler"){ return redirect('/daimler'); }
    if ($brand == "FIAT")   { return redirect('/fiat');    }

    if ($brand == "TOYOTA")  { return redirect('/toyota'); }
    if ($brand == "PSA")     { return redirect('/psa');    }
    if ($brand == "GM")      { return redirect('/gm');     }
    if ($brand == "HYUNDAI") { return redirect('/hyundai');}
    if ($brand == "MAZDA")   { return redirect('/mazda');  }
    if ($brand == "SUZUKI")  { return redirect('/suzuki'); }

    return view('layouts.layout');
});

Route::get('/bmw','bmw@viewtwenty');

Route::get('/vag', 'vag@viewtwenty');
Route::get('/volvo', 'volvo@viewtwenty');

Route::get('/daimler', 'daimler@viewtwenty');

Route::get('/fiat', 'fiat@viewtwenty');
Route::get('/toyota', 'toyota@viewtwenty');
Route::get('/psa', 'psa@viewtwenty');
Route::get('/gm', 'gm@viewtwenty');
Route::get('/hyundai', 'hyundai@viewtwenty');
Route::get('/mazda', 'mazda@viewtwenty');
Route::get('/suzuki', 'suzuki@viewtwenty');

/**********************************************************************/


Route::get('/bmwimp','bmwimportcontroller@import');

//Route::get('/vagimp','vagimportcontroller@fileUploadPost');

Route::get('/vagimp','vagimportcontroller@import');

Route::post('/delinput','delInputFile@index');

Route::get('/dwbase','downloadDatabase@index');

Route::get('/log',   'logview@index');
Route::get('/files',   'fileview@index');
Route::get('/clearlog','logview@clear');

Route::get('/status','databasestatus@index');
Route::get('/newprice','databasestatus@price');


Route::post('/update','UpdateRecord@update');
Route::post('/updatenp','UpdateRecord@updatenp');
Route::post('/updates','UpdateRecord@updatemany');
Route::post( '/additions','addrecords@index');

Route::post('/file-upload', 'UploadFileController@fileUploadPost')->name('file.upload.post');
Route::get('/getnumber','programming@index');
