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

    public function searchAssigned() {
    
        $search = $_GET['searchAssignedAdvisee'];
    
        // $assigned = Advisee::whereHas('advisor', function($query) use ($search) {
        //     $query->where('advisee_fname', 'LIKE','%'.$search.'%'); })->get();
    
        $assigned = advisee::select('advisees.*', 'advisors.advisor_name')
            ->where('advisee_fname', 'LIKE','%'.$search.'%')
            ->join('advisors', 'advisors.advisor_id', '=', 'advisees.advisor_id')
            ->get();
            //->whereNotNull('advisor_id')
           
        // $advisee = json_decode($assigned, true);
        // $value = DB::table('advisors')->where('advisor_id' , $advisee->advisor_id)->get();
        
        return view('hop.searchAssigned',['assigned'=>$assigned]);
            //return $assigned;
    }
    
    public function infoAssigned($advisee_id) {
        //$value = advisee::find($advisee_id);
        //if(Session::has('loginId')){
            $value = advisee::select('advisees.*', 'advisors.advisor_name')
                ->where('advisee_id', '=', $advisee_id)
                ->join('advisors', 'advisors.advisor_id', '=', 'advisees.advisor_id')
                ->get();

            $data = json_decode($value, true);

            return view('hop.infoAssigned', ['data'=>$data]);
       //}
    }

    public function manageadvisor($advisee_id) {
        $value = advisee::select('advisees.*', 'advisors.advisor_name')
                ->where('advisee_id', '=', $advisee_id)
                ->join('advisors', 'advisors.advisor_id', '=', 'advisees.advisor_id')
                ->get();

            $data = json_decode($value, true);

        $available = DB::table('advisors')
            ->where('advisor_quota', '<', 2)
            ->get();
        $advisor = json_decode($available, true);

            return view('hop.manageadvisor', ['data'=>$data , 'advisor'=>$advisor]);
    }

    public function unassignedAdvisee() {

        $value = DB::table('advisees')->where('advisor_id' , NULL)->get();
        //$value = DB::select('SELECT * FROM advisees WHERE advisor_id = ?' , [''])
        $unassigned = json_decode($value, true);

        $available = DB::table('advisors')
                    ->where('advisor_quota', '<', 2)
                    ->get();
        $advisor = json_decode($available, true);

       return view('hop.unassignedAdvisee', ['data'=>$unassigned, 'advisor'=>$advisor]);
   }

   public function assign(Request $req) {

    $advisorid = $req->advisor_id;
    $adviseeid = $req->advisee_id;
    $adviseename = $req->advisee_fname;
    
    for ($i = 0; $i < count($adviseeid); $i++) {
        $advisee = Advisee::find($adviseeid[$i]);
    
        $max_quota = 30; // Set maximum increment value to 30
        $advisor = Advisor::where('advisor_id', $advisorid[$i])->first();
        $quota = intval($advisor->advisor_quota);
    
        if ($quota <= $max_quota) {
            $advisee->advisor_id = $advisorid[$i];
    
            $increase = $quota + 1;
            Advisor::where('advisor_id', $advisorid[$i])->update(['advisor_quota' => (string) $increase]);
            $advisee->save();
            return redirect('/unassignedAdvisee')->with('success', 'Advisor has been successfully assigned');
        } else {
            return redirect('/unassignedAdvisee')->with('error', 'Advisor has been fully assigned');
        }
    }
    
        // $id = $req->advisor_id;
        // $advisee = advisee::find($req->advisee_id);
        
        // $max_quota = 30; // Set maximum increment value to 10
        // $advisor = DB::table('advisors')->where('advisor_id', $id)->first();
        // $quota = intval($advisor->advisor_quota);
        
        // if ($quota <= $max_quota) {
        //     $advisee->advisor_id = $id;
        //     $advisee->save();

        //     $increase = $quota + 1;
        //     DB::table('advisors')->where('advisor_id', $id)->update(['advisor_quota' => (string) $increase]);
        // } else {
        //     return back()->with('error', 'Advisor has been fully assigned');
        // }

        // return redirect('/unassignedAdvisee');
   }

   public function changeadvisor(Request $req){
        $id = $req->advisor_id;
        $currentname = $req->current_advisor_name;
        
        $max_quota = 30; // Set maximum increment value to 10
        $advisor = DB::table('advisors')->where('advisor_id', $id)->first();
        $quota = intval($advisor->advisor_quota);

        $currentadvisor = DB::table('advisors')->where('advisor_name', $currentname)->first();
        $currentquota = intval($currentadvisor->advisor_quota);

        //DB::table('advisees')->where('advisee_id', $req->advisee_id)->update(['advisor_id' => (string) $advisor->advisor_id]);
        
        if ($quota <= $max_quota) {
            $advisee = advisee::find($req->advisee_id);
            DB::table('advisees')->where('advisee_id', $req->advisee_id)->update(['advisor_id' => (string) $id]);
            //$advisee->advisor_id = $id;
            $decrease = $currentquota - 1;
            DB::table('advisors')->where('advisor_name', $currentname)->update(['advisor_quota' => (string) $decrease]);

            $increase = $quota + 1;
            DB::table('advisors')->where('advisor_id', $id)->update(['advisor_quota' => (string) $increase]);

            return back()->with('success', 'You have successfully changed advisor!');
        } else {
            return back()->with('error', 'Advisor has been fully assigned');
        }
        //return redirect('/assignedAdvisee');
   }

   public function searchUnassigned(Request $req) {

    $search = $_GET['searchUnassignedAdvisee'];

    $unassigned = DB::table('advisees')
        ->where('advisee_fname', 'LIKE','%'.$search.'%')
        ->whereNULL('advisor_id')
        ->get();

    $advisee = json_decode($unassigned, true);
    
    $advisor = advisor::all();
    return view('hop.searchUnassigned',['unassigned'=>$advisee, 'advisor'=>$advisor]);
}

    public function infoUnassigned($advisee_id) {
        $value = advisee::find($advisee_id);
        //if(Session::has('loginId')){

        $available = DB::table('advisors')
            ->where('advisor_quota', '<', 30)
            ->get();
        $advisor = json_decode($available, true);
        return view('hop.infoUnassigned', ['display'=>$value, 'advisor'=>$advisor]);
    //}
    }
//    $unassigned = Advisee::whereHas('advisor', function($query) use ($search) {
//     $query->where('advisee_fname', 'LIKE','%'.$search.'%'); })->get();

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
        //if(Session::has('loginId')){
            return view('hop.infoAdvisor', ['display'=>$value]);
       //}
    }

}
