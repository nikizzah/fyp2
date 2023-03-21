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

    public function unassignedAdvisee() {

        $value = DB::table('advisees')->where('advisor_id' , NULL)->get();
        //$value = DB::select('SELECT * FROM advisees WHERE advisor_id = ?' , [''])
        $unassigned = json_decode($value, true);

        $advisor = advisor::all();
       return view('hop.unassignedAdvisee', ['data'=>$unassigned, 'advisor'=>$advisor]);
   }

   public function assign(Request $req) {

        $id = $req->advisor_id;
        $advisee = advisee::find($req->advisee_id);
        // $value = DB::table('advisors')->where('advisor_name' , $req->assign)->first();
        // $advisor = json_decode($value, true);
        //$value = DB::select('SELECT * FROM advisors WHERE advisor_name = ?' , [$req->assign]);
        //DB::table('advisees')->select('advisor_id')->where('advisee_id', $req->advisee_id)->insert(['advisor_id' => $advisor->advisor_id]);
        $advisor = advisor::find($id);
        $max = 2;
        DB::table('advisors')
            ->where('advisor_id', $id)
            ->increment('advisor_quota',['max_advisor_quota' => $max]);

            // if ($add > $max) {
            //     // Display an error message here
            //     return response()->json(['error' => 'You have exceeded the maximum value.']);
            // } else {
            //     return response()->json(['success' => 'You have assigned an advisee.']);
            // }

        // if($advisor = true) {
        //     $advisor->advisor_quota
        // }
        // $advisee->advisor_id = $id;

        // $value = DB::table('advisees')
        //  ->join('advisors','advisors.advisor_id', '=', 'advisees.advisor_id');

        $advisee->save();

        return redirect('/unassignedAdvisee');
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

}
