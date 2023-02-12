<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminControl;

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

//admin-subject
Route::get('/createSubj', function () {
    return view('admin.createSubj');
});
Route::get('/subj', [adminControl::class, 'displaySubj']);
Route::get('/delSubj/{x}', [adminControl::class, 'deleteSubj']);

//admin-advisee
Route::get('/createAdvisee', function () {
    return view('admin.createAdvisee');
});
Route::get('/advisee', [adminControl::class, 'displayAdvisee']);
Route::get('/delAdvisee/{x}', [adminControl::class, 'deleteAdvisee']);

//admin-advisor
Route::get('/createAdvisor', function () {
    return view('admin.createAdvisor');
});
Route::get('/advisor', [adminControl::class, 'displayAdvisor']);
Route::get('/delAdvisor/{x}', [adminControl::class, 'deleteAdvisor']);

//admin-hop
Route::get('/createHOP', function () {
    return view('admin.createHOP');
});
Route::get('/hop', [adminControl::class, 'displayHOP']);
Route::get('/delHOP/{x}', [adminControl::class, 'deleteHOP']);

//admin-cs
Route::get('/cs', function () {
    return view('admin.cs');
});

