<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminControl;
use App\Http\Controllers\hopControl;
use App\Http\Controllers\adviseeControl;
use App\Http\Controllers\advisorControl;
use App\Http\Livewire\Planning;
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
//homepage
Route::get('/home', function () {
    return view('home');
});

//admin register-login-logout
Route::get('/adminlogin', [adminControl::class, 'login'])->middleware('adminAlreadyLoggedIn');
Route::get('/adminregister', [adminControl::class, 'registration']);
Route::post('/registeradmin', [adminControl::class, 'register']);
Route::post('/loginadmin', [adminControl::class, 'adminlogin']);
Route::get('/adminlogout', [adminControl::class, 'adminlogout']);

//admin subject
Route::get('/subj', [adminControl::class, 'displaySubj'])->middleware('adminLoggedIn');
Route::get('/createSubj', [adminControl::class, 'createSubj']);
Route::post('/insertSubj', [adminControl::class, 'insertSubj']);
Route::post('/importSubj', [adminControl::class, 'importSubj']);
Route::get('/delSubj/{x}', [adminControl::class, 'deleteSubj']);
Route::get('/updSubj/{x}', [adminControl::class, 'updateSubj']);
Route::post('/editSubj', [adminControl::class, 'editSubj']);
Route::get('/searchAdminSubject', [adminControl::class, 'searchSubject']);

//admin advisee

Route::get('/createAdvisee', [adminControl::class, 'createAdvisee']);
Route::get('/advisee', [adminControl::class, 'chooseintakeAdvisee']);
Route::post('/insertAdvisee', [adminControl::class, 'insertAdvisee']);
Route::post('/showadvisee', [adminControl::class, 'showadvisee']);
Route::get('/delAdvisee/{x}', [adminControl::class, 'deleteAdvisee']);
Route::get('/updAdvisee/{x}', [adminControl::class, 'updateAdvisee']);
Route::post('/editAdvisee', [adminControl::class, 'editAdvisee']);
Route::get('/searchAdminAdvisee', [adminControl::class, 'searchAdvisee']);

    //1. insert file advisees
Route::get('/assignadvisee', [adminControl::class,'displayAdvisee']);
    //2. import into database and go to c-s livewire to view 
Route::post('/importAdvisee', [adminControl::class,'advisee']);
    //3. get data from insert-advisee livewire and display
Route::get('/show-advisees', function () {
    $advisees = session('advisees');
    return view('admin.advisee', compact('advisees'));
})->name('show-advisees');


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
Route::get('/searchAdminAdvisor', [adminControl::class, 'searchAdvisor']);

//admin hop
Route::get('/createHOP', function () {
    return view('admin.createHOP');
});
Route::post('/insertHOP', [adminControl::class, 'insertHOP']);
Route::get('/hop', [adminControl::class, 'displayHOP']);
Route::get('/delHOP/{x}', [adminControl::class, 'deleteHOP']);

//admin cs
Route::get('/cs', [adminControl::class,'cs']); 

Route::get('/csintake', [adminControl::class,'csintake']); 
Route::post('/intakeadmin', [adminControl::class,'cs']); 
Route::get('/intakeCS', function () {
    return view('admin.intake');
});
    //1. insert file subjects
Route::get('/assignintake', [adminControl::class,'displayintake']);
    //2. import into database and go to c-s livewire to view 
Route::post('/importIntake', [adminControl::class,'intake']);
    //3. get data from c-s livewire and display
Route::get('/show-subjects', function () {
    $subjects = session('subjects');
    return view('admin.cs', compact('subjects'));
})->name('show-subjects');

Route::post('/subjects', [adminControl::class, 'subjects']);

//hop register-login-logout
Route::get('/hoplogin', [hopControl::class, 'login'])->middleware('hopAlreadyLoggedIn');
Route::get('/hopregister', [hopControl::class, 'registration']);
Route::post('/registerhop', [hopControl::class, 'register']);
Route::post('/loginhop', [hopControl::class, 'hoplogin']);
Route::get('/hoplogout', [hopControl::class, 'hoplogout']);
Route::get('/hopforgot', function () {
    return view('hop.resetPassword');
});
Route::post('/resethop', [hopControl::class, 'reset']);

//hop choose advisee
Route::get('/chooseadvisee', function () {
    return view('hop.chooseAdvisee');
});
Route::post('/chooseListAdvisee', [hopControl::class, 'chooseListAdvisee']);

//hop assigned advisee
Route::get('/assignedAdvisee', [hopControl::class, 'chooseIntakeAssigned']);
Route::get('/searchAssignedAdvisee', [hopControl::class, 'searchAssigned']);
Route::get('/infoAssigned/{x}', [hopControl::class, 'infoAssigned']);
Route::get('/infoAssigned/manageadvisor/{x}', [hopControl::class, 'manageadvisor']);
Route::post('/change', [hopControl::class, 'changeadvisor']);
Route::post('/intakeAssignedhop', [hopControl::class, 'assignedAdvisee']);

//hop advisor list
Route::get('/advisorlist', [hopControl::class, 'advisor']);
Route::get('/Adviseeassigned/{x}', [hopControl::class, 'adviseeAssigned']);
Route::get('/searchAdvisor', [hopControl::class, 'searchAdvisor']);
Route::get('/infoAdvisor/{x}', [hopControl::class, 'infoAdvisor']);
Route::get('Adviseeassigned/infoAssigned/{x}', [hopControl::class, 'infoAssigned']);

//hop unassigned advisee
Route::get('/unassignedAdvisee', [hopControl::class, 'chooseIntake']);
Route::post('/assign', [hopControl::class, 'assign']);
Route::get('/searchUnassigned', [hopControl::class, 'searchUnassigned']);
Route::get('/infoUnassigned/{x}', [hopControl::class, 'infoUnassigned']);
Route::post('/assignone', [hopControl::class, 'assignalone']);
Route::post('/intakehop', [hopControl::class, 'unassignedAdvisee']);

//hop report
Route::get('/report', [hopControl::class, 'report']);

//advisee register-login-logout
Route::get('/adviseelogin', [adviseeControl::class, 'login'])->middleware('adviseeAlreadyLoggedIn');
Route::get('/adviseeregister', [adviseeControl::class, 'registration']);
Route::post('/registeradvisee', [adviseeControl::class, 'register']);
Route::post('/loginadvisee', [adviseeControl::class, 'adviseelogin']);
Route::get('/adviseelogout', [adviseeControl::class, 'adviseelogout']);
Route::get('/adviseeforgot', function () {
    return view('advisee.resetPassword');
});
Route::post('/resetadvisee', [adviseeControl::class, 'reset']);

//advisee info page
Route::get('/adviseeInfoAdvisee', [adviseeControl::class, 'infoAdvisee']);
Route::post('/AdviseeEdit', [adviseeControl::class, 'editAdvisee']);
Route::get('/advisorInfoAdvisee', [adviseeControl::class, 'infoAdvisor']);

//advisee cs
Route::get('/courseStructureAdvisee',[adviseeControl::class, 'cs']);

//advisee planning
    Route::get('/chooseyear', [adviseeControl::class, 'year']);
    Route::get('/chooseintake', function () {
        return view('advisee.chooseIntake');
    });
    Route::get('/show-planning', function () {
        $subjects = session('subjects');
        return view('advisee.planning', ['subjects' => $subjects]);
    })->name('show-planning');
    Route::get('/planning',[adviseeControl::class, 'plan']);

//advisor register-login-logout
Route::get('/advisorlogin', [advisorControl::class, 'loginadvisor'])->middleware('advisorAlreadyLoggedIn');
Route::get('/advisorregister', [advisorControl::class, 'registration']);
Route::post('/registeradvisor', [advisorControl::class, 'register']);
Route::post('/loginadvisor', [advisorControl::class, 'advisorlogin']);
Route::get('/advisorlogout', [advisorControl::class, 'advisorlogout']);
Route::get('/advisorforgot', function () {
    return view('advisor.resetPassword');
});
Route::post('/resetadvisor', [advisorControl::class, 'reset']);

//advisor list advisee
Route::get('/listadvisee', [advisorControl::class, 'advisee']);
Route::get('/emailall', [advisorControl::class, 'emailall']);
Route::post('/sendall', [advisorControl::class, 'sendall']);
Route::get('/emailone/{x}', [advisorControl::class, 'emailone']);
Route::post('/sendone', [advisorControl::class, 'sendone']);
Route::get('/searchAdvisee', [advisorControl::class, 'searchAdvisee']);
Route::get('/viewed/{x}', [advisorControl::class, 'viewed']);

//advisor adviseePlan
Route::get('/planAdvisee/{x}', [advisorControl::class, 'plan']);
Route::post('/planningAdvisor',[advisorControl::class, 'year']);

//advisor info page
Route::get('/advisorInfo', [advisorControl::class, 'infoAdvisor']);
Route::post('/AdvisorEdit', [advisorControl::class, 'editAdvisor']);
Route::get('/adviseeInfo/{x}', [advisorControl::class, 'infoAdvisee']);

//advisor cs
Route::post('/intakeadvisor', [advisorControl::class, 'intakeadvisor']);
Route::get('/courseStructure',[advisorControl::class, 'chooseintake']);