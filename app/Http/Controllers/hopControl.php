<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hop;
use Hash;
use Session;

class hopControl extends Controller
{
    public function login() {
        return view('hop.login');
    }

    public function registration() {
        return view('hop.register');
    }

    public function register(Request $req) {
        // $req->validate([
        //      'hop_id'=>'required|hop_id|unique:hops',
        //      'hop_name'=>'required',
        //      'hop_password'=>'required|min:5|max:10'
        //  ]);
        $hop = new hop();
        $hop->hop_id  = $req->hop_id;
        $hop->hop_name  = $req->hop_name;
        $hop->hop_password  = Hash::make($req->hop_password);
        
        $save= $hop->save();
        if($save){
            return back()->with('success', 'Successfully Registered');
        }else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function hoplogin(Request $req) {
        // $req->validate([
        //      'hop_id'=>'required|hop_id|unique:hops',
        //      'hop_password'=>'required'
        //  ]);

        $hop = hop::where('hop_id', '=', $req->hop_id)->first();
        if ($hop) {
            if(Hash::check($req->hop_password, $hop->hop_password)) {
                $req->session()->put('hoploginId', $hop->hop_id);
                return redirect('/chooseadvisee');
            }else {
                return back()->with('fail', 'Wrong password');
            }
        }else {
            return back()->with('fail', 'This id is not registered');
        }
    }

    public function hoplogout(){
        if(Session::has('hoploginId')){
            Session::pull('hoploginId');
            return redirect('/hoplogin');
        }
    }
}
