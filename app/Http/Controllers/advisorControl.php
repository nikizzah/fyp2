<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Notifications\EmailAll;
use App\Notifications\EmailOne;
use App\Models\advisor;
use App\Models\advisee;
use App\Models\subject;
use App\Models\course_structure;
use Hash;
use Session;
use Auth;
use DB;

class advisorControl extends Controller
{
    public function loginadvisor() {
        return view('advisor.login');
    }

    public function registration() {
        return view('advisor.register');
    }

    public function advisorlogin(Request $req) {

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
            return redirect('/home');
        }
    }

    public function reset(Request $req) {
        $req->validate([
            'advisor_id'=>'required',
            'newpass' => 'required|min:5|max:10'
        ]);

        $advisor = advisor::find($req->advisor_id);

        if($advisor){
            $currentPassword = $req->advisor_password;
            $newPassword = $req->newpass;
        
            // Validate the current password
            if (!Hash::check($currentPassword, $advisor->advisor_password)) {
                return back()->with('fail', 'Incorrect current password');
            }
            
            else {
                // Update the password
                $advisor->advisor_password = Hash::make($newPassword);
                $advisor->save();
                
                return redirect('/advisorlogin')->with('success', 'Password updated successfully');
            }
        }else{
            return back()->with('fail', 'This id is not registered');
        }
    }

    public function advisee() {
        $advisorId = session()->get('advisorloginId');
    
        $advisor = advisor::find($advisorId);
    
        // Retrieve all the advisees associated with the advisor
        $advisees = $advisor->advisees;
    
        // Display the list of advisees
        if(isset($advisees) && (is_array($advisees) || is_object($advisees)) && count($advisees) > 0) {
            return view('advisor.adviseelist', ['data'=>$advisees, 'advisor' => $advisor->advisor_name]);
        } else {
            return redirect('/listadvisee')->with('fail', 'You have no advisees.');
        }
    }

    public function infoAdvisor() {
        $advisorId = session()->get('advisorloginId');
        $advisor = advisor::find($advisorId);
            return view('advisor.infoAdvisor', ['display'=>$advisor]);
    }

    public function editAdvisor(Request $req) {
        $req->validate([
            'advisor_email' => 'required|email',
            'advisor_ext' => 'required|numeric',
        ]);
        
        $value = advisor::find($req->advisor_id);

        $value->advisor_id = $req->advisor_id;
        $value->advisor_name = $req->advisor_name;
        $value->advisor_ext = $req->advisor_ext;
        $value->advisor_email = $req->advisor_email;
        $value->advisor_quota = $req->advisor_quota;
        $value->save();

        $advisorId = session()->get('advisorloginId');

        $advisor = advisor::find($advisorId);
        session()->flash('success', 'Successfully updated');
        return view('advisor.infoAdvisor', ['display'=>$advisor, 'advisor' => $advisor->advisor_id]);
    }

    public function infoAdvisee($advisee_id) {
        $value = advisee::find($advisee_id);
            $advisorId = session()->get('advisorloginId');
        return view('advisor.infoAdvisee', ['display'=>$value]);
    }

    public function searchAdvisee(Request $req) {
        $advisorId = session()->get('advisorloginId');
        $search = $_GET['searchAdvisee'];

        $advisee = DB::table('advisees')
            ->where('advisee_fname', 'LIKE','%'.$search.'%')
            ->where('advisor_id', '=', $advisorId)
            ->get();

        $advisees = json_decode($advisee, true);

        return view('advisor.searchAdvisee',['advisee'=>$advisees]);
    }

    public function plan($advisee_id){
        $advisee = advisee::find($advisee_id);
        return view('advisor.subjectPlan', ['advisee'=>$advisee]);
    }

    public function emailall() {
        $advisorId = session()->get('advisorloginId');
    
        $advisor = advisor::find($advisorId);
    
        $advisees = $advisor->advisees;
    
        if(isset($advisees) && (is_array($advisees) || is_object($advisees)) && count($advisees) > 0) {
            return view('advisor.all', ['data'=>$advisees]);
        } else {
            return redirect('/listadvisee')->with('fail', 'You have no advisees.');
        }
    }

    public function sendall(Request $req) {
        if ($req->advisee_email != "") {
        $advisorId = session()->get('advisorloginId');
        $advisor = advisor::find($advisorId);

        if ($advisor) {
            $advisees = advisee::where('advisor_id', $advisorId)->get();

            $emailContent = $req->description;
            $emailSubject = $req->subject;

            foreach ($advisees as $advisee) {
                // Send email to each advisee
                $notificationAdvisee = new EmailAll($emailContent, $emailSubject, $advisor, $advisee);
                Mail::to($advisee->advisee_email)->send($notificationAdvisee->toMail($advisee));
            }

            return response()->json(['success' => 'Email sent to all advisees']);
        } else {
            return response()->json(['error' => 'Advisor not found']);
        }
    } else {
        return response()->json(['error' => 'Kindly enter an email']);
    }
    }

    public function emailone($advisee_id) {

        $advisee = advisee::find($advisee_id);
        return view('advisor.one', ['data'=>$advisee]);
    }

    public function sendone(Request $req) {
        if ($req->advisee_email != "") {
            $advisee = DB::table('advisees')->where('advisee_fname', '=', $req->advisee_fname)->first();
            if ($advisee) {

                $emailContent = $req->description;
                $emailSubject = $req->subject;

                    $notificationAdvisee = new EmailOne($emailContent, $emailSubject,  $advisee);
                    Mail::to($advisee->advisee_email)->send($notificationAdvisee->toMail($advisee));


            return response()->json(['success' => 'Email sent to advisee']);
            } else {
                return response()->json(['error' => 'Advisee not found']);
            }
        } else {
            return response()->json(['error' => 'Kindly enter an email']);
        }
    }

    public function viewed($advisee_id){
        $advisee = advisee::find($advisee_id);
        $advisee->advisee_status = "Old";
        $advisee->save();
        return back();
    }

    public function chooseIntake() {
        $intake = course_structure::all();
        if(Session::has('advisorloginId')){
        return view('advisor.chooseIntake', ['subjects'=>$intake]);
        }
    }

    public function intakeadvisor(Request $req){
        $value = subject::where('cs_id', $req->intake)
                    ->orderBy('subject_year', 'asc')
                    ->orderBy('subject_semester', 'asc')
                    ->orderBy('subject_category', 'asc')
                    ->get()
                    ->groupBy(['subject_year', 'subject_semester', 'subject_category']);
        $total = DB::table('subjects')->where('cs_id', $req->intake)->sum('subject_credithr');
        return view('advisor.cs', ['data'=>$value, 'total'=>$total]);
    }

    public function cs (){
        $value = subject::orderBy('subject_year', 'asc')
                    ->orderBy('subject_semester', 'asc')
                    ->orderBy('subject_category', 'asc')
                    ->get()
                    ->groupBy(['subject_year', 'subject_semester', 'subject_category']);
        $total = DB::table('subjects')->where('cs_id', $req->intake)->sum('subject_credithr');
        return view('advisor.cs', ['data'=>$value, 'total'=>$total]);
    }

}
