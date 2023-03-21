<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\advisee;
use App\Models\advisor;
use App\Models\hop;
use App\Models\subject;
use App\Models\admin;
use Hash;
use Session;
use Excel;
use App\Imports\AdviseeImport;
use App\Imports\AdvisorImport;
use App\Imports\SubjectImport;
// use App\Imports\HOPImport;
//use ZipArchive;


class adminControl extends Controller
{
    public function login() {
        return view('admin.login');
    }

    public function registration() {
        return view('admin.register');
    }

    public function register(Request $req) {

         $req->validate([
              'admin_id'=>'required',
              //'admin_name'=>'required',
              'admin_password'=>'required|min:5|max:10'
          ]);
        
          $check = admin::where('admin_id', '=', $req->admin_id)->first();
          if($check){
            return back()->with('fail', 'This id is already registered');
          }else {
            $admin = new admin();
            $admin->admin_id  = $req->admin_id;
            //$admin->admin_name  = $req->admin_name;
            $admin->admin_password  = Hash::make($req->admin_password);
            $save= $admin->save();
            if($save){
                return back()->with('success', 'Successfully Registered');
            }else {
                return back()->with('fail', 'Something wrong');
            }
        }

    }

    public function adminlogin(Request $req) {
         $req->validate([
              'admin_id'=>'required',
              'admin_password'=>'required'
          ]);

        $admin = admin::where('admin_id', '=', $req->admin_id)->first();
        if ($admin) {
            if(Hash::check($req->admin_password, $admin->admin_password)) {
                $req->session()->put('loginId', $admin->admin_id);
                return redirect('/subj');
            }else {
                return back()->with('fail', 'Wrong password');
            }
        }else {
            return back()->with('fail', 'This id is not registered');
        }
    }

    public function adminlogout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/adminlogin');
        }
    }

    //advisee
    public function displayAdvisee() {
        $value = advisee::all();
        if(Session::has('loginId')){
            return view('admin.advisee', ['data'=>$value]);
       }
    }

    public function insertAdvisee(Request $req) {
        $req->validate([
            'advisee_cgpa'=>'required|numeric|min:0.0|max:4.0',
            'advisee_email' => 'required|email'
        ]);
        $value = new advisee();

        $value->advisee_id = $req->advisee_id;
        $value->advisee_fname = $req->advisee_fname;
        $value->advisee_address = $req->advisee_address;
        $value->advisee_town = $req->advisee_town;
        $value->advisee_state = $req->advisee_state;
        $value->advisee_postcode = $req->advisee_postcode;
        $value->advisee_email = $req->advisee_email;
        $value->advisee_contact = $req->advisee_contact;
        $value->advisee_status = $req->advisee_status;
        $value->advisee_cgpa = $req->advisee_cgpa;

        $value->save();
        return redirect('/advisee');
    }

    public function updateAdvisee($advisee_id) {
        $value = advisee::find($advisee_id);
        if(Session::has('loginId')){
            return view('admin.updateAdvisee', ['display'=>$value]);
       }
    }

    public function editAdvisee(Request $req) {
        $req->validate([
            'advisee_cgpa'=>'required|numeric|min:0.0|max:4.0',
            'advisee_email' => 'required|email'
        ]);
                $value = advisee::find($req->advisee_id);

                $value->advisee_id = $req->advisee_id;
                $value->advisee_fname = $req->advisee_fname;
                $value->advisee_address = $req->advisee_address;
                $value->advisee_town = $req->advisee_town;
                $value->advisee_state = $req->advisee_state;
                $value->advisee_postcode = $req->advisee_postcode;
                $value->advisee_email = $req->advisee_email;
                $value->advisee_contact = $req->advisee_contact;
                $value->advisee_status = $req->advisee_status;
                $value->advisee_cgpa = $req->advisee_cgpa;

                $value->save();
                return redirect('/advisee');
        
    }

    public function deleteAdvisee($advisee_id) {
        DB::delete('delete from advisees where advisee_id=?', [$advisee_id]);
        return redirect('/advisee');
    }

    public function importAdvisee(Request $req){
        Excel::import(new AdviseeImport, $req->advisee_file);

        return redirect('/advisee')->with('success', 'File uploaded successfully.');
    }

    //advisor
    public function insertAdvisor(Request $req) {
        $req->validate([
            'advisor_quota'=>'required|numeric|min:0|max:35',
            'advisor_email' => 'required|email'
        ]);
        $value = new advisor();

        $value->advisor_id = $req->advisor_id;
        $value->advisor_name = $req->advisor_name;
        $value->advisor_ext = $req->advisor_ext;
        $value->advisor_email = $req->advisor_email;
        $value->advisor_quota = $req->advisor_quota;
        $value->advisor_position = $req->advisor_position;
        $value->advisor_status = $req->advisor_status;
        $value->save();
        return redirect('/advisor');
    }



    public function displayAdvisor() {
        $value = advisor::all();
        if(Session::has('loginId')){
            return view('admin.advisor', ['data'=>$value]);
       }
    }

    public function updateAdvisor($advisor_id) {
        $value = advisor::find($advisor_id);
        if(Session::has('loginId')){
            return view('admin.updateAdvisor', ['display'=>$value]);
       }
    }

    public function editAdvisor(Request $req) {
        $req->validate([
            'advisor_quota'=>'required|numeric|min:0|max:35',
            'advisor_email' => 'required|email'
        ]);
        
        $value = advisor::find($req->advisor_id);

        $value->advisor_id = $req->advisor_id;
        $value->advisor_name = $req->advisor_name;
        $value->advisor_ext = $req->advisor_ext;
        $value->advisor_email = $req->advisor_email;
        $value->advisor_quota = $req->advisor_quota;
        $value->advisor_position = $req->advisor_position;
        $value->advisor_status = $req->advisor_status;
        $value->save();
        return redirect('/advisor');
    }

    public function deleteAdvisor($advisor_id) {
        DB::delete('delete from advisors where advisor_id=?', [$advisor_id]);
        return redirect('/advisor');
    }

    public function importAdvisor(Request $req){
        Excel::import(new AdvisorImport, $req->advisor_file);
        return redirect('/advisor');
    }

    //subject

    public function displaySubj() {
        $value = subject::all();
        if(Session::has('loginId')){
             return view('admin.subj', ['data'=>$value]);
        }
    }

    public function insertSubj(Request $req) {

        $create = subject::where('subject_code', '=', $req->subject_code)->first();
        if ($create) {
                return back()->with('fail', 'This subject has already been created');
            }else {
                $value = new subject();

                $value->subject_code = $req->subject_code;
                $value->subject_name = $req->subject_name;
                $value->subject_credithr = $req->subject_credithr;
                $value->subject_category = $req->subject_category;
                $value->subject_prerequisite = $req->subject_prerequisite;

                $value->save();
                return redirect('/subj');
            }
        
    }

    public function updateSubj($subject_code) {
        $value = subject::find($subject_code);
        if(Session::has('loginId')){
            return view('admin.updateSubject', ['display'=>$value]);
       }
    }

    public function editSubj(Request $req) {

        $value = subject::find($req->$subject_code);

        $value->subject_code = $req->subject_code;
        $value->subject_name = $req->subject_name;
        $value->subject_credithr = $req->subject_credithr;
        $value->subject_category = $req->subject_category;
        $value->subject_prerequisite = $req->subject_prerequisite;

        $value->save();
        return redirect('/subj');
            
    }

    public function deleteSubj($subject_code) {
        DB::delete('delete from subjects where subject_code=?', [$subject_code]);
        return redirect('/subj');
    }

    public function importSubj(Request $req){
        Excel::import(new SubjectImport, $req->subject_file);
        return redirect('/subj');
    }

    //hop
    public function displayHOP() {
        $value = DB::table('advisors')->where('advisor_position' ,'Head of Program')->get();
        //$value = DB::select('SELECT * FROM advisors WHERE advisor_position = ?' , ['Head of Program']);
        
        $hop = json_decode($value, true);
        if(Session::has('loginId')){
            return view('admin.hop', ['data'=>$hop]);
       }
    }

    public function insertHOP(Request $req) {
        $value = new hop();

        $value->hop_id = $req->hop_id;
        $value->hop_name = $req->hop_name;

        $value->save();
        return redirect('/hop');
    }

    public function deleteHOP($hop_id) {
        DB::delete('delete from hops where hop_id=?', [$hop_id]);
        return redirect('/hop');
    }

    //cs

    public function cs (){
        $subject = subject::all();
       return view('admin.cs', ['data'=>$subject]);
    }
    public function chooseCS(Request $req) {

        $value = DB::table('advisees')->where('advisor_id' , NULL)->get();
        //$value = DB::select('SELECT * FROM advisees WHERE advisor_id = ?' , [''])
        $unassigned = json_decode($value, true);

        $advisor = advisor::all();
       return view('hop.unassignedAdvisee', ['data'=>$unassigned, 'advisor'=>$advisor]);

        $year = subject::find($req->year);

        $cs = DB::table('subjects')
        ->where('subject_year', )
        ->whereNULL('advisor_id')
        ->get();
    }
}
