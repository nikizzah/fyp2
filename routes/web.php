<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminControl;
use App\Http\Controllers\hopControl;
use App\Http\Controllers\adviseeControl;
use App\Http\Controllers\advisorControl;
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
//admin register-login-logout
Route::get('/adminlogin', [adminControl::class, 'login'])->middleware('adminAlreadyLoggedIn');
Route::get('/adminregister', [adminControl::class, 'registration']);
Route::post('/registeradmin', [adminControl::class, 'register']);
Route::post('/loginadmin', [adminControl::class, 'adminlogin']);
Route::get('/adminlogout', [adminControl::class, 'adminlogout']);

//admin subject
Route::get('/subj', [adminControl::class, 'displaySubj'])->middleware('adminLoggedIn');
Route::get('/createSubj', function () {
    return view('admin.createSubj');
});
Route::post('/insertSubj', [adminControl::class, 'insertSubj']);
Route::post('/importSubj', [adminControl::class, 'importSubj']);
Route::get('/delSubj/{x}', [adminControl::class, 'deleteSubj']);
Route::get('/updSubj/{x}', [adminControl::class, 'updateSubj']);
Route::post('/editSubj', [adminControl::class, 'editSubj']);

//admin advisee
Route::get('/createAdvisee', function () {
    return view('admin.createAdvisee');
});
Route::get('/advisee', [adminControl::class, 'displayAdvisee']);
Route::post('/insertAdvisee', [adminControl::class, 'insertAdvisee']);
Route::post('/importAdvisee', [adminControl::class, 'importAdvisee']);
Route::get('/delAdvisee/{x}', [adminControl::class, 'deleteAdvisee']);
Route::get('/updAdvisee/{x}', [adminControl::class, 'updateAdvisee']);
Route::post('/editAdvisee', [adminControl::class, 'editAdvisee']);


//admin advisor
Route::get('/createAdvisor', function () {
    return view('admin.createAdvisor');
});
Route::post('/insertAdvisor', [adminControl::class, 'insertAdvisor']);
Route::get('/advisor', [adminControl::class, 'displayAdvisor']);
Route::post('/importAdvisor', [adminControl::class, 'importAdvisor']);
Route::get('/delAdvisor/{x}', [adminControl::class, 'deleteAdvisor']);
Route::get('/updAdvisor/{x}', [adminControl::class, 'updateAdvisor']);
Route::post('/editAdvisor', [adminControl::class, 'editAdvisor']);

//admin hop
Route::get('/createHOP', function () {
    return view('admin.createHOP');
});
Route::post('/insertHOP', [adminControl::class, 'insertHOP']);
Route::get('/hop', [adminControl::class, 'displayHOP']);
Route::get('/delHOP/{x}', [adminControl::class, 'deleteHOP']);

//admin cs
Route::get('/cs', function () {
    return view('admin.cs');
});

//hop register-login-logout
Route::get('/hoplogin', [hopControl::class, 'login'])->middleware('hopAlreadyLoggedIn');
Route::get('/hopregister', [hopControl::class, 'registration']);
Route::post('/registerhop', [hopControl::class, 'register']);
Route::post('/loginhop', [hopControl::class, 'hoplogin']);
Route::get('/hoplogout', [hopControl::class, 'hoplogout']);

//hop choose advisee
Route::get('/chooseadvisee', function () {
    return view('hop.chooseAdvisee');
});
Route::post('/chooseListAdvisee', [hopControl::class, 'chooseListAdvisee']);

//hop assigned advisee
Route::get('/assignedAdvisee', [hopControl::class, 'assignedAdvisee']);

//hop advisor list
Route::get('/advisorlist', [hopControl::class, 'advisor']);

//hop unassigned advisee
Route::get('/unassignedAdvisee', [hopControl::class, 'unassignedAdvisee']);
Route::post('/assign', [hopControl::class, 'assign']);
Route::get('/searchUnassigned', [hopControl::class, 'searchUnassigned']);

//advisee register-login-logout
Route::get('/adviseelogin', [adviseeControl::class, 'login'])->middleware('adviseeAlreadyLoggedIn');
Route::get('/adviseeregister', [adviseeControl::class, 'registration']);
Route::post('/registeradvisee', [adviseeControl::class, 'register']);
Route::post('/loginadvisee', [adviseeControl::class, 'adviseelogin']);
Route::get('/adviseelogout', [adviseeControl::class, 'adviseelogout']);

//advise choose year
Route::get('/chooseyear', function () {
    return view('advisee.chooseYear');
});

//advisor register-login-logout
Route::get('/advisorlogin', [advisorControl::class, 'login'])->middleware('advisorAlreadyLoggedIn');
Route::get('/advisorregister', [advisorControl::class, 'registration']);
Route::post('/registeradvisor', [advisorControl::class, 'register']);
Route::post('/loginadvisor', [advisorControl::class, 'advisorlogin']);
Route::get('/advisorlogout', [advisorControl::class, 'advisorlogout']);

//advisor list advisee
Route::get('/listadvisee', function () {
    return view('advisor.advisee');
});
