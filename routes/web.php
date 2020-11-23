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


Route::get('/', function () {
    return view('layouts.layout');
});


Route::get('/edit', function(){

    return view('layouts.layout');

});



Route::get('/suzuki', function(Request $request){
    $request->session()->put('brand', 'suzuki');
    //session(['brand' => 'suzuki']);
    $request->session()->save();
    dd($request->session()->get('brand'));
    return "SUZUKI";
  //  $request->session()->put('brand', 'suzuki');
  //  session(['brand' => 'suzuki']);
    //$request->session()->put('brand', 'suzuki');
    //$request->session()->save();

    //d($request->session()->get('brand'));

   // $data = $request->session()->all();
    //dd($data);
});



Route::get('/volvo', function(Request $request){
    $request->session()->put('brand', 'volvo');
    $request->session()->save();
    //session(['brand' => 'volvo']);
    dd($request->session()->get('brand'));
      return "VOLVO";
});

Route::get('/bmw', function(Request $request){
    //session(['brand' => 'bmv']);
    $request->session()->put('brand', 'bmw');
    $request->session()->save();
    dd($request->session()->get('brand'));
    return "BMV";
});

Route::get('/vag', function(Request $request){
    $request->session()->put('brand', 'vag');
    $request->session()->save();
   // session(['brand' => 'vag']);
    dd($request->session()->get('brand'));
    return "VAG";
});


Route::get('file-upload', 'UploadFileController@fileUpload')->name('file.upload');
Route::post('file-upload', 'UploadFileController@fileUploadPost')->name('file.upload.post');

