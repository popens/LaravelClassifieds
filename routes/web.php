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
Route::get('/login', function () {
    return 'Login';
});
Route::get('/logout', function () {
    return 'Logout';
});
Route::get('/registration', function () {
    return 'Registration';
});
Route::get('/forgot-password', function () {
    return 'Forgot Password';
});
Route::get('/reset-password', function () {
    return 'Reset Password';
});

Route::get('/profile/dashboard', function () {
    return 'Dashboard';
});
Route::get('/profile/edit', function () {
    return 'Edit Profile';
});
Route::get('/profile/edit', function () {
    return 'Edit Profile';
});
