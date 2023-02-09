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

//admin
Route::get('/', function () {
    return view('admin.subj');
});

Route::get('/advisee', function () {
    return view('admin.advisee');
});

Route::get('/advisor', function () {
    return view('admin.advisor');
});

Route::get('/hop', function () {
    return view('admin.hop');
});

Route::get('/cs', function () {
    return view('admin.cs');
});

