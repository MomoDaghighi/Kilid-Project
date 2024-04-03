<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home.index');
});

Route::group(['namespace' => '\App\Http\Controllers\panel','middleware' => ['auth:web','verify'],'prefix' => 'panel'], function () {

    Route::get('/', function () {
        return view('panel.index');
    })->name('panel');

    Route::get('user/', 'UserController@edit')->name('panel.user.edit');
    Route::patch('user/update/{user}', 'UserController@update')->name('panel.user.update');

});

Route::group(['namespace' => '\App\Http\Controllers\agency','middleware' => ['auth:web','verify'],'prefix' => 'agency'], function () {

    Route::get('/', function () {
        return view('agency.index');
    })->name('agency');

    Route::get('user/', 'UserController@edit')->name('agency.user.edit');
    Route::patch('user/update/{user}', 'UserController@update')->name('agency.user.update');

    Route::resource('advertises', 'AdvertiseController');
    Route::post('image/upload', 'AdvertiseController@upload');

});


Route::group(['namespace' => '\App\Http\Controllers\home','middleware' => ['auth:web']], function () {

    Route::get('/verify', 'VerifyController@show');
    Route::post('/verify', 'VerifyController@verify')->name('home.verify');


});

Route::group(['namespace' => '\App\Http\Controllers\home'], function () {

    Route::get('avertises', 'AdvertiseController@index');

    Route::get('avertises/{advertise}', 'AdvertiseController@show')->name('home.advertise.show');

    Route::get('search/ajax', 'AdvertiseController@searchajax');
   

});


// Route::group(['namespace' => '\App\Http\Controllers\admin',  'prefix' => 'admin'], function () {

//     //import
//     Route::get('import', 'ImportController@show');
//     Route::post('import', 'ImportController@store')->name('import.store');

// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
