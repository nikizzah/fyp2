<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advisee;
use App\Models\advisor;
use App\Models\subject;
use Hash;
use Session;
use DB;

class adviseeControl extends Controller
{
    public function login() {
        return view('advisee.login');
    }

    public function registration() {
        return view('advisee.register');
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
                return redirect('/planning');
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
                return redirect('/home');
            }
    }

    public function reset(Request $req) {
            $req->validate([
                'advisee_id'=>'required',
                'advisee_password' => 'required',
                'newpass' => 'required|min:5|max:10'
            ]);

            $advisee = advisee::find($req->advisee_id);
            if($advisee){
                $currentPassword = $req->advisee_password;
                $newPassword = $req->newpass;
                if (!Hash::check($currentPassword, $advisee->advisee_password)) {
                    return back()->with('fail', 'Incorrect current password');
                }
                
                else {
                    // Update the password
                    $advisee->advisee_password = Hash::make($newPassword);
                    $advisee->save();
                    return redirect('/adviseelogin')->with('success', 'Password updated successfully');
                }
            }else{
                return back()->with('fail', 'This id is not registered');
            }
    }

    public function infoAdvisor() {
        if(Session::has('adviseeloginId')){
            $adviseeId = session()->get('adviseeloginId');
            $advisee = advisee::find($adviseeId);

            $advisor = advisor::where('advisor_id', '=', $advisee->advisor_id)->first();
            if ($advisor !== null) {
                return view('advisee.infoAdvisor', ['display' => $advisor]);
            } else {
                return view('advisee.noadvisor')->with('fail', 'You dont havee any advisor');
            }
        }
    }

    public function infoAdvisee() {

        $adviseeId = session()->get('adviseeloginId');
        $advisee = advisee::find($adviseeId);
        return view('advisee.infoAdvisee', ['display'=>$advisee]);
    }

    public function editAdvisee(Request $req) {
        if(Session::has('adviseeloginId')){
            $req->validate([
                'advisee_cgpa' => 'required|numeric|min:0.0|max:4.0',
                'advisee_email' => 'required|email',
                'advisee_postcode' => 'required|numeric',
                'advisee_contact' => 'required|numeric|max_digits:11',
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
            $value->advisee_cgpa = $req->advisee_cgpa;

            $value->save();
            $adviseeId = session()->get('adviseeloginId');

            $advisee = advisee::find($adviseeId);
            session()->flash('success', 'Successfully updated');
            return view('advisee.infoAdvisee', ['display'=>$advisee]);
        }
    }

    public function cs (){
        $adviseeId = session()->get('adviseeloginId');
        $intake = DB::table('advisees')->where('advisee_id', $adviseeId)->value('cs_id');
      
            $value = subject::where('cs_id', $intake)
                        ->orderBy('subject_year', 'asc')
                        ->orderBy('subject_semester', 'asc')
                        ->orderBy('subject_category', 'asc')
                        ->get()
                        ->groupBy(['subject_year', 'subject_semester', 'subject_category']);
            $total = DB::table('subjects')->where('cs_id',$intake)->sum('subject_credithr');
            if(Session::has('adviseeloginId')){
            return view('advisee.cs', ['data'=>$value, 'total'=>$total]);
        }
    }

    public function year()
    {
        if(Session::has('adviseeloginId')){
            $adviseeId = session()->get('adviseeloginId');
            $advisee = advisee::find($adviseeId);

            $subjects = subject::select('subject_year')
                ->where('subjects.cs_id', '=', $advisee->cs_id)
                ->orderBy('subject_year', 'asc')
                ->groupBy('subject_year')
                ->get();

            return view('advisee.chooseYear', ['display' => $advisee, 'subjects' => $subjects]);
        }
    }

    public function plan()
    {
        if(Session::has('adviseeloginId')){
            $adviseeId = session()->get('adviseeloginId');
            $advisee = advisee::find($adviseeId);
            return view('advisee.planning', ['advisee'=>$advisee]);
        }
    }
}
