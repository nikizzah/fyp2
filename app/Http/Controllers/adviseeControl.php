<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advisee;
use Hash;
use Session;

class adviseeControl extends Controller
{
    public function login() {
        return view('advisee.login');
    }

    public function registration() {
        return view('advisee.register');
    }

    public function register(Request $req) {
        $req->validate([
            'advisee_id'=>'required',
            'advisee_fname'=>'required',
            'advisee_password'=>'required|min:5|max:10'
        ]); 
        $check = advisee::where('advisee_id', '=', $req->advisee_id)->first();
          if($check){
            return back()->with('fail', 'This id is already registered');
          }else {
            $advisee = new advisee();
            $advisee->advisee_id  = $req->advisee_id;
            $advisee->advisee_fname  = $req->advisee_fname;
            $advisee->advisee_password  = Hash::make($req->advisee_password);
            
            $save= $advisee->save();
            if($save){
                return back()->with('success', 'Successfully Registered');
            }else {
                return back()->with('fail', 'Something wrong');
            }
        }
        
    }

    public function adviseelogin(Request $req) {
         $req->validate([
              'advisee_id'=>'required',
              'advisee_password'=>'required'
          ]);

        $advisee = advisee::where('advisee_id', '=', $req->advisee_id)->first();
        if ($advisee) {
            if(Hash::check($req->advisee_password, $advisee->advisee_password)) {
                $req->session()->put('adviseeloginId', $advisee->advisee_id);
                return redirect('/chooseyear');
            }else {
                return back()->with('fail', 'Wrong password');
            }
        }else {
            return back()->with('fail', 'This id is not registered');
        }
    }

    public function adviseelogout(){
        if(Session::has('adviseeloginId')){
            Session::pull('adviseeloginId');
            return redirect('/adviseelogin');
        }
    }

}
