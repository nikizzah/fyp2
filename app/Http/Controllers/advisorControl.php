<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advisor;
use Hash;
use Session;

class advisorControl extends Controller
{
    public function login() {
        return view('advisor.login');
    }

    public function registration() {
        return view('advisor.register');
    }

    public function register(Request $req) {
        $req->validate([
            'advisor_id'=>'required',
            'advisor_name'=>'required',
            'advisor_password'=>'required|min:5|max:10'
        ]); 
        $check = advisor::where('advisor_id', '=', $req->advisor_id)->first();
          if($check){
            return back()->with('fail', 'This id is already registered');
          }else {
            $advisor = new advisor();
            $advisor->advisor_id  = $req->advisor_id;
            $advisor->advisor_name  = $req->advisor_name;
            $advisor->advisor_password  = Hash::make($req->advisor_password);
            
            $save= $advisor->save();
            if($save){
                return back()->with('success', 'Successfully Registered');
            }else {
                return back()->with('fail', 'Something wrong');
            }
        }
        
    }

    public function advisorlogin(Request $req) {
        // $req->validate([
        //      'admin_id'=>'required|admin_id|unique:admins',
        //      'admin_password'=>'required'
        //  ]);

        $advisor = advisor::where('advisor_id', '=', $req->advisor_id)->first();
        if ($advisor) {
            if(Hash::check($req->advisor_password, $advisor->advisor_password)) {
                $req->session()->put('advisorloginId', $advisor->advisor_id);
                return redirect('/listadvisee');
            }else {
                return back()->with('fail', 'Wrong password');
            }
        }else {
            return back()->with('fail', 'This id is not registered');
        }
    }

    public function advisorlogout(){
        if(Session::has('advisorloginId')){
            Session::pull('advisorloginId');
            return redirect('/advisorlogin');
        }
    }

}
