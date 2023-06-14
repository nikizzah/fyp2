<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AssignmentNotification;
use App\Models\hop;
use App\Models\advisee;
use App\Models\course_structure;
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

    public function hoplogin(Request $req) {
         $req->validate([
              'hop_id'=>'required',
              'hop_password'=>'required|min:5|max:10'
          ]);

        $hop = hop::where('hop_id', '=', $req->hop_id)->first();
        if ($hop) {
            if(Hash::check($req->hop_password, $hop->hop_password)) {
                $req->session()->put('hoploginId', $hop->hop_id);
                return redirect('/unassignedAdvisee');
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
            return redirect('/home');
        }
    }

    public function reset(Request $req) {
        $req->validate([
            'hop_id'=>'required',
            'newpass' => 'required|min:5|max:10'
        ]);

        $hop = hop::find($req->hop_id);

        if($hop){
            $currentPassword = $req->hop_password;
            $newPassword = $req->newpass;
        
            // Validate the current password
            if (!Hash::check($currentPassword, $hop->hop_password)) {
                return back()->with('fail', 'Incorrect current password');
            }
            
            else {
                // Update the password
                $hop->hop_password = Hash::make($newPassword);
                $hop->save();
                
                return redirect('/hoplogin')->with('success', 'Password updated successfully');
            }
        }else{
            return back()->with('fail', 'This id is not registered');
        }
    }

    public function chooseListAdvisee(Request $req) {
        if($req->listAdvisee == 'Assigned')
            return redirect('/assignedAdvisee');
        elseif($req->listAdvisee == 'Unassigned')
            return redirect('/unassignedAdvisee');
    }

    public function assignedAdvisee(Request $req) {
        
         $value = DB::table('advisees')
         ->where('cs_id', '=', $req->intake) 
         ->join('advisors','advisors.advisor_id', '=', 'advisees.advisor_id')
         ->select('advisees.*', 'advisors.advisor_name')
         ->paginate(10);

         $intake = DB::table('course_structures')
        ->where('cs_id', '=', $req->intake)
        ->value('cs_intake');
        return view('hop.assignedAdvisee', ['data'=>$value, 'intake'=>$intake]);
    }

    public function searchAssigned(Request $req) {
    
        $search = $_GET['searchAssignedAdvisee'];
    
        $intake = DB::table('course_structures')
        ->where('cs_intake', '=', $req->intake)
        ->value('cs_id');

        $assigned = advisee::select('advisees.*', 'advisors.advisor_name')
            ->where('cs_id', '=', $intake)
            ->where('advisee_fname', 'LIKE','%'.$search.'%')
            ->join('advisors', 'advisors.advisor_id', '=', 'advisees.advisor_id')
            ->get();
           
        $intakeID = DB::table('course_structures')
        ->where('cs_id', '=', $intake)
        ->value('cs_intake');
        
        return view('hop.searchAssigned',['assigned'=>$assigned, 'intake' => $intakeID]);
    }
    
    public function infoAssigned($advisee_id) {
            $value = advisee::select('advisees.*', 'advisors.advisor_name')
                ->where('advisee_id', '=', $advisee_id)

                ->join('advisors', 'advisors.advisor_id', '=', 'advisees.advisor_id')
                ->get();

            $data = json_decode($value, true);

            return view('hop.infoAssigned', ['data'=>$data]);
    }

    public function manageadvisor($advisee_id) {
        $value = advisee::select('advisees.*', 'advisors.advisor_name')
                ->where('advisee_id', '=', $advisee_id)
                ->join('advisors', 'advisors.advisor_id', '=', 'advisees.advisor_id')
                ->get();

            $data = json_decode($value, true);
        $available = DB::table('advisors')
            ->where('advisor_id', '!=', $data[0]['advisor_id'])
            ->get();
        $advisor = json_decode($available, true);

            return view('hop.manageadvisor', ['data'=>$data , 'advisor'=>$advisor]);
    }

    public function unassignedAdvisee(Request $req) {

        $value = DB::table('advisees')
            ->where('advisor_id' , NULL)
            ->where('cs_id', '=', $req->intake)
            ->get();
        $unassigned = json_decode($value, true);

        $intake = DB::table('course_structures')
        ->where('cs_id', '=', $req->intake)
        ->value('cs_intake');

        $available = DB::table('advisors')
                    ->get();
        $advisor = json_decode($available, true);
        if(Session::has('hoploginId')){
            return view('hop.unassignedAdvisee', ['data'=>$unassigned, 'advisor'=>$advisor, 'intake'=>$intake]);
        }
   }

   public function assign(Request $req)
    {
        $advisorIds = $req->advisor_id;
        $adviseeIds = $req->advisee_id;
        $adviseeNames = $req->advisee_fname;
        $successCount = 0;
        $errorCount = 0;
        $assignedAdvisorIds = []; 
        $assignedAdvisees = []; 
        if ($advisorIds != "") {
            for ($i = 0; $i < count($adviseeIds); $i++) {
                $advisee = advisee::find($adviseeIds[$i]); 
                $maxQuota = 30; 

                if (isset($advisorIds[$i])) {
                    $advisor = advisor::where('advisor_id', $advisorIds[$i])->first(); 
                    $quota = intval($advisor->advisor_quota);
                } else {
                    $errorCount++;
                    continue; 
                }

                if ($quota <= $maxQuota) {
                    $advisee->advisor_id = $advisorIds[$i];
                    $advisee->advisee_status = 'New';

                    $increase = $quota + 1;
                    advisor::where('advisor_id', $advisorIds[$i])->update(['advisor_quota' => (string) $increase]); 
                    $advisee->save();
                    $successCount++;

                    // Store the assigned advisee for each advisor
                    $assignedAdvisees[$advisorIds[$i]][] = $adviseeNames[$i];
                } else {
                    $errorCount++;
                }
            }

            if ($successCount > 0) {
                foreach ($assignedAdvisees as $advisorId => $adviseeNames) {
                    $advisor = advisor::find($advisorId);
                    // Send email to advisor
                    $advisorDescription =  " ". implode(", ", $adviseeNames);
                    $notificationAdvisor = new AssignmentNotification($advisorDescription, null, $advisor, null);
                    Mail::to($advisor->advisor_email)->send($notificationAdvisor->toMail($advisor));


                    // Send email to advisees
                    foreach ($adviseeNames as $adviseeName) {
                        $advisee = advisee::where('advisee_fname', $adviseeName)->first();
                    
                        if ($advisee) {
                            $adviseeDescription = " " . $advisor->advisor_name;
                            $notificationAdvisee = new AssignmentNotification(null, $adviseeDescription, $advisor, null);
                            Mail::to($advisee->advisee_email)->send($notificationAdvisee->toMail($advisee));
                        }
                    }
                    
                }

            return response()->json(['success' => $successCount . ' student(s) have been successfully assigned']);
        } else if ($errorCount > 0) {
            return response()->json(['error' => 'Advisor has been fully assigned']);
        } 
    }else {
            return response()->json(['error' => 'No advisors selected']);
        }
    }

   public function assignalone(Request $req) {
        if ($req->advisor_id != "") {
            $id = $req->advisor_id;
            $advisee = advisee::find($req->advisee_id);
            
            $max_quota = 30; 
            $advisor = DB::table('advisors')->where('advisor_id', $id)->first();
            $quota = intval($advisor->advisor_quota);
            
            if ($quota <= $max_quota) {
                $advisee->advisor_id = $id;
                $advisee->save();

                $increase = $quota + 1;
            DB::table('advisors')->where('advisor_id', $id)->update(['advisor_quota' => (string) $increase]);
            // Send email to advisor
            $advisorDescription = " " . $advisee->advisee_fname;
            $notificationAdvisor = new AssignmentNotification($advisorDescription, null, $advisor, $advisee);
            Mail::to($advisor->advisor_email)->send($notificationAdvisor->toMail($advisor));
        
            // Send email to advisee
            $adviseeDescription = " " . $advisor->advisor_name;
            $notificationAdvisee = new AssignmentNotification(null, $adviseeDescription, $advisor, $advisee);
            Mail::to($advisee->advisee_email)->send($notificationAdvisee->toMail($advisee));
            return response()->json(['success' => ' Advisor has been successfully assigned']);
            } else {
                return response()->json(['error' => 'Advisor has been fully assigned']);
            }
        }else {
            return response()->json(['error' => 'No advisors selected']);
        }
   }

   public function changeadvisor(Request $req){
    if ($req->advisor_id != "") {
        $id = $req->advisor_id;
        $currentname = $req->current_advisor_name;
        
        $max_quota = 30;
        $advisor = DB::table('advisors')->where('advisor_id', $id)->first();
        $quota = intval($advisor->advisor_quota);

        $currentadvisor = DB::table('advisors')->where('advisor_name', $currentname)->first();
        $currentquota = intval($currentadvisor->advisor_quota);

        if ($quota <= $max_quota) {
            $advisee = advisee::find($req->advisee_id);
            DB::table('advisees')->where('advisee_id', $req->advisee_id)->update(['advisor_id' => (string) $id]);
            $decrease = $currentquota - 1;
            DB::table('advisors')->where('advisor_name', $currentname)->update(['advisor_quota' => (string) $decrease]);

            $increase = $quota + 1;
            DB::table('advisors')->where('advisor_id', $id)->update(['advisor_quota' => (string) $increase]);
            // Send email to advisor
            $advisorDescription = " " . $advisee->advisee_fname;
            $notificationAdvisor = new AssignmentNotification($advisorDescription, null, $advisor, $advisee);
            Mail::to($advisor->advisor_email)->send($notificationAdvisor->toMail($advisor));

            // Send email to advisee
            $adviseeDescription = " " . $advisor->advisor_name;
            $notificationAdvisee = new AssignmentNotification(null, $adviseeDescription, $advisor, $advisee);
            Mail::to($advisee->advisee_email)->send($notificationAdvisee->toMail($advisee));
            return response()->json(['success' => 'Advisor has been successfully changed']);
        } else {
            return response()->json(['error' => 'Advisor has been fully assigned']);
        }  
    }else {
        return response()->json(['error' => 'No advisors selected']);
    }
    }

   public function searchUnassigned(Request $req) {

        $search = $_GET['searchUnassignedAdvisee'];

        $intake = DB::table('course_structures')
        ->where('cs_intake', '=', $req->intake)
        ->value('cs_id');
        
        $unassigned = DB::table('advisees')
            ->where('cs_id', '=', $intake)
            ->where('advisee_fname', 'LIKE','%'.$search.'%')
            ->whereNULL('advisor_id')
            ->get();

        $intakeID = DB::table('course_structures')
            ->where('cs_id', '=', $intake)
            ->value('cs_intake');
        
        $advisee = json_decode($unassigned, true);
        
        $advisor = advisor::all();
        return view('hop.searchUnassigned',['unassigned'=>$advisee, 'advisor'=>$advisor, 'intake' => $intakeID]);
    }

    public function infoUnassigned($advisee_id) {
        $value = advisee::find($advisee_id);

        $available = DB::table('advisors')
            ->where('advisor_quota', '<', 30)
            ->get();
        $advisor = json_decode($available, true);
        return view('hop.infoUnassigned', ['display'=>$value, 'advisor'=>$advisor]);
    }

   public function advisor() {
        $value = advisor::all();

        return view('hop.advisor', ['data'=>$value]);
   }

   public function searchAdvisor() {

        $search = $_GET['searchAdvisor'];

        $advisor = DB::table('advisors')
            ->where('advisor_name', 'LIKE','%'.$search.'%')
            ->get();

        $data = json_decode($advisor, true);
        
        return view('hop.searchAdvisor',['advisor'=>$data]);

    }

    public function infoAdvisor($advisor_id) {
        $value = advisor::find($advisor_id);
            return view('hop.infoAdvisor', ['display'=>$value]);
    }

    public function adviseeAssigned($advisor_id){
        $advisor = advisor::find($advisor_id);

        $advisees = $advisor->advisees;
        // Display the list of advisees
        if(isset($advisees) && (is_array($advisees) || is_object($advisees)) && count($advisees) > 0) {
            return view('hop.adviseeAssigned', ['data'=>$advisees, 'advisor' => $advisor]);
        } else {
            return back()->with('fail', 'No advisees assigned.');
        }
    }

    public function report()
    {
        $totalAdvisees = advisee::count();

        $advisorPositions = advisor::select('advisor_position')
        ->groupBy('advisor_position')
        ->get();

        // Calculate the percentage of advisor assignment for each position
         foreach ($advisorPositions as $advisorPosition) {
             $quota = advisor::where('advisor_position', $advisorPosition->advisor_position)
             ->sum('advisor_quota');
             $percentage = ($quota / $totalAdvisees) * 100;
             $roundedPercentage = number_format($percentage, 2);

             $reportData[] = [
                 'advisorPosition' => $advisorPosition,
                 'quota' => $quota,
                 'totalAdvisees' => $totalAdvisees,
                 'percentage' => $roundedPercentage,
             ];
         }

        return view('hop.report', ['reportData' => $reportData]);
    }


    public function chooseIntake() {
            $intake = course_structure::all();
            if(Session::has('hoploginId')){
            return view('hop.chooseIntake', ['subjects'=>$intake]);
            }
    }

    public function chooseIntakeAssigned() {
        $intake = course_structure::all();
        if(Session::has('hoploginId')){
        return view('hop.chooseIntakeAssigned', ['subjects'=>$intake]);
        }
    }

}
