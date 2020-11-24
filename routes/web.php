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
/*




Route::get('/edit', function(){

    return view('layouts.layout');

});




Route::get('/{brand?}',function(Request $request, $brand = '*'){
    $request->session()->put('brand', $brand);
return view('layouts.layout');
});
*/

Route::get('/', function () {
    return view('layouts.layout');
});

Route::get('/vag', function(Request $request){
    $request->session()->put('brand', 'vag');

    return view('layouts.layout');
});

Route::get('/volvo', function(Request $request){
    $request->session()->put('brand', 'volvo');
    return view('layouts.layout');
});

/*
Route::get('/bmw', function(Request $request){

    $request->session()->put('brand', 'bmw');
    return view('layouts.layout');
}); */
Route::get('/bmw','bmw@viewtwenty');

/**********************************************************************/

Route::get('/toyota', function(Request $request){
    $request->session()->put('brand', 'toyota');
    return view('layouts.layout');
});


Route::get('/psa', function(Request $request){
    //session(['brand' => 'bmv']);
    $request->session()->put('brand', 'psa');
    return view('layouts.layout');
});

Route::get('/gm', function(Request $request){
    //session(['brand' => 'bmv']);
    $request->session()->put('brand', 'gm');
    return view('layouts.layout');
});



Route::get('/daimler', function(Request $request){

    $request->session()->put('brand', 'daimler');
    return view('layouts.layout');
});

Route::get('/fiat', function(Request $request){

    $request->session()->put('brand', 'fiat');
    return view('layouts.layout');
});

Route::get('/daimler', function(Request $request){

    $request->session()->put('brand', 'daimler');
    return view('layouts.layout');
});

Route::get('/hyuidai', function(Request $request){

    $request->session()->put('brand', 'hyuidai');
    return view('layouts.layout');
});

Route::get('/mazda', function(Request $request){

    $request->session()->put('brand', 'mazda');
    return view('layouts.layout');
});


Route::get('/suzuki', function(Request $request){

    $request->session()->put('brand', 'suzuki');
    return view('layouts.layout');
});

Route::get('/user','usercontroller@import');

/*
Route::get('/suzuki','SessionController@storeSessionData');
Route::get('/volvo','SessionController@storeSessionData');


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
*/

Route::get('file-upload', 'UploadFileController@fileUpload')->name('file.upload');
Route::post('file-upload', 'UploadFileController@fileUploadPost')->name('file.upload.post');


