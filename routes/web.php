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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//All user related routs should be inside this group
Route::middleware('auth')->group(function() {
    Route::get('/user/dashboard', function() {
        return view('user/dashboard');
    });
});

//route for classifed list all page
Route::get('/classifieds', function() {
    return view('/post/classified-all');
})->name('classifieds');

//Route for classified form to create new
Route::get('/classified/new', function() {
    return view('/post/classified-new');
});

//Route for edit form for classified
Route::get('/classified/edit/{id}', function() {
    return view('/post/classified-edit');
});

//For DB update
Route::post('classified/create', 'postsController@create')->name('createClassified');
Route::get('classified/update/{id}', 'postsController@update')->name('updateClassified');
Route::get('classified/delete/{id}', 'postsController@delete')->name('deleteClassified');