<?php

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
use Illuminate\Support\Str;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function() {
    Route::get('/user/dashboard', function() {
        return view('user/dashboard');
    });
});

Route::get("/classified/delete/{i}", "ListingsController@delete")->name('deletelisting');
Route::get('/classifieds', 'ListingsController@listAll')->name('classifieds');
Route::get('/classified/edit/{i}', 'ListingsController@edit')->name('editlisting');
Route::get('/classified/{i}/{t}', 'ListingsController@view')->name('viewlisting');

Route::get("/classified/new", function() {
    return view("/classifieds/classified-new");
})->name('addlistings');

Route::post("/classified/create", "ListingsController@create")->name('add');
Route::post("/classified/update/{i}", "ListingsController@update")->name('update');
Route::get("/classified/{i}/delete/{y}", "ListingsController@deleteImage")->name('deleteimage');