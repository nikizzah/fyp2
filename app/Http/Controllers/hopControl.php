<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hop;
use App\Models\advisee;
use App\Models\advisor;
use Hash;
use DB;
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
        $req->validate([
            'hop_id'=>'required',
            'hop_name'=>'required',
            'hop_password'=>'required|min:5|max:10'
        ]); 
        $check = hop::where('hop_id', '=', $req->hop_id)->first();
          if($check){
            return back()->with('fail', 'This id is already registered');
          }else {
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
        
    }

    public function hoplogin(Request $req) {
         $req->validate([
              'hop_id'=>'required',
              'hop_password'=>'required|min:5|max:10'
          ]);

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

    public function chooseListAdvisee(Request $req) {
        if($req->listAdvisee == 'Assigned')
            return redirect('/assignedAdvisee');
        elseif($req->listAdvisee == 'Unassigned')
            return redirect('/unassignedAdvisee');
    }

    public function assignedAdvisee() {
        
         $value = DB::table('advisees')
         ->join('advisors','advisors.advisor_id', '=', 'advisees.advisor_id')
         ->select('advisees.*', 'advisors.advisor_name')
         ->get();

        //$value = advisee::all();

        return view('hop.assignedAdvisee', ['data'=>$value]);
    }

    public function unassignedAdvisee() {

        $value = DB::table('advisees')->where('advisor_id' , NULL)->get();
        //$value = DB::select('SELECT * FROM advisees WHERE advisor_id = ?' , [''])
        $unassigned = json_decode($value, true);

        $advisor = advisor::all();
       return view('hop.unassignedAdvisee', ['data'=>$unassigned, 'advisor'=>$advisor]);
   }

   public function assign(Request $req) {

        $advisee = advisee::find($req->advisee_id);
        $value = DB::table('advisors')->where('advisor_name' , $req->advisor_name)->first();
        $advisor = json_decode($value, true);
        //$value = DB::select('SELECT advisor_id FROM advisors WHERE advisor_name = ?' , [$req->advisor_name]);

        //DB::table('advisees')->select('advisor_id')->where('advisee_id', $req->advisee_id)->insert(['advisor_id' => $advisor->advisor_id]);

        $advisee->advisor_id = $value;

        $advisee->save();

        // $record = advisors::where('advisor_name', $req->advisor_name)->first();
        // $advisee = advisee::find($req->advisee_id);
        // $advisee->advisor_id = $record->advisor_id;
        // $advisee->save();

        
        return redirect('/unassignedAdvisee');
   }

   public function searchUnassigned() {
    
   }

   public function advisor() {
        $value = advisor::all();

        return view('hop.advisor', ['data'=>$value]);
   }

}
