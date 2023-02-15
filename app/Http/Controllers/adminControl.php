<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\advisee;
use App\Models\advisor;
use App\Models\hop;
use App\Models\subject;
use App\Models\admin;
use Hash;
use Session;

class adminControl extends Controller
{
    public function login() {
        return view('admin.login');
    }

    public function registration() {
        return view('admin.register');
    }

    public function register(Request $req) {
        // $req->validate([
        //      'admin_id'=>'required|admin_id|unique:admins',
        //      'admin_name'=>'required',
        //      'admin_password'=>'required|min:5|max:10'
        //  ]);
        $admin = new admin();
        $admin->admin_id  = $req->admin_id;
        $admin->admin_name  = $req->admin_name;
        $admin->admin_password  = Hash::make($req->admin_password);
        
        $save= $admin->save();
        if($save){
            return back()->with('success', 'Successfully Registered');
        }else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function adminlogin(Request $req) {
        // $req->validate([
        //      'admin_id'=>'required|admin_id|unique:admins',
        //      'admin_password'=>'required'
        //  ]);

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

    public function displayAdvisee() {
        $value = advisee::all();
        return view('admin.advisee', ['data'=>$value]);
    }

    public function deleteAdvisee($advisee_id) {
        DB::delete('delete from advisees where advisee_id=?', [$advisee_id]);
        return redirect('/advisee');
    }

    public function displayAdvisor() {
        $value = advisor::all();
        return view('admin.advisor', ['data'=>$value]);
    }

    public function deleteAdvisor($advisor_id) {
        DB::delete('delete from advisors where advisor_id=?', [$advisor_id]);
        return redirect('/advisor');
    }

    public function displaySubj() {
        $value = subject::all();
        if(Session::has('loginId')){
             return view('admin.subj', ['data'=>$value]);
        }
    }

    public function deleteSubj($subject_code) {
        DB::delete('delete from subjects where subject_code=?', [$subject_code]);
        return redirect('/subj');
    }

    public function displayHOP() {
        $value = hop::all();
        return view('admin.hop', ['data'=>$value]);
    }

    public function deleteHOP($hop_id) {
        DB::delete('delete from hops where hop_id=?', [$hop_id]);
        return redirect('/hop');
    }
}
