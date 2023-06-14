<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AssignmentNotification;
use Excel;
use App\Models\advisee;
use App\Models\advisor;
use App\Models\hop;
use App\Models\subject;
use App\Models\admin;
use App\Models\course_structure;
use Hash;
use Session;
use App\Imports\AdviseeImport;
use App\Imports\AdvisorImport;
use App\Imports\SubjectImport;

class adminControl extends Controller
{
    public function login() {
        return view('admin.login');
    }

    public function registration() {
        return view('admin.register');
    }

    public function adminlogin(Request $req) {
         $req->validate([
              'admin_id'=>'required',
              'admin_password'=>'required'
          ]);

        $admin = admin::where('admin_id', '=', $req->admin_id)->first();
        if ($admin) {
            if(Hash::check($req->admin_password, $admin->admin_password)) {
                $req->session()->put('loginId', $admin->admin_id);
                return redirect('/assignintake');
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
            return redirect('/home');
        }
    }

    //advisee
    public function displayAdvisee() {
        $intake = course_structure::pluck('cs_intake', 'cs_id');
        if(Session::has('loginId')){
            return view('admin.insertAdvisee', ['intakes'=>$intake]);
        }
    }

    public function createAdvisee()
    {
        $intakes = course_structure::pluck('cs_intake', 'cs_id');
        if(Session::has('loginId')){
        return view('admin.createAdvisee', ['intakes' => $intakes]);
        }
    }

    public function advisee(Request $req)
    {
        $req->validate([
            'intake' => 'nullable',
        ]);

        $intakeId = $req->intake;

        if (is_null($intakeId) && !is_null($req->new_intake)) {
            // Create a new intake
            $req->validate([
                'new_intake' => [
                    'required',
                    'unique:course_structures,cs_intake',
                    function ($attribute, $value, $error) {
                        // Check if the input matches the desired format
                        if (!preg_match('/^\d{4}\/\d{2}T\d$/', $value)) {
                            $error('New Intake must be in the format of year/year trimester number (e.g., 2019/20T1).');
                        }
                    },
                ],
            ]);
            $newIntake = $req->new_intake;

            $existingIntake = course_structure::where('cs_intake', $newIntake)->first();

            if ($existingIntake) {
                return back()->with('error', 'Intake already exists.');
            }

            $intake = new course_structure();
            $intake->cs_intake = $newIntake;
            $intake->save();

            $intakeId = $intake->cs_id;
        } else if (!is_null($intakeId) && !is_null($req->new_intake)) {
            return back()->with('error', 'Kindly select OR create a new intake.');
        } else if (is_null($intakeId) && is_null($req->new_intake)) {
            return back()->with('error', 'Kindly select or create a new intake before uploading.');
        }

        $adviseeImport = new AdviseeImport($intakeId);
        // Get the imported advisees from the Excel file
        $importedAdvisees = Excel::toCollection($adviseeImport, $req->advisee_file)->first();

        // Extract the advisee id from the imported advisee
        $importedAdviseesID = $importedAdvisees->pluck('advisee_id')->toArray();

        // Check for duplicate advisees
        $duplicateAdvisees = advisee::whereIn('advisee_id', $importedAdviseesID)
            ->get();

        if ($duplicateAdvisees->isNotEmpty()) {
            return back()->with('error','Some advisees already exist. Please check the file and remove duplicates.');
        }
        Excel::import($adviseeImport, $req->advisee_file);

        $subjects = subject::where('cs_id', $intakeId)->get();
        if ($subjects) {
            $adviseeIds = $adviseeImport->getImportedAdvisees();
            $advisees = advisee::whereIn('advisee_id', $adviseeIds)->where('cs_id', $intakeId)->get();
        
            foreach ($advisees as $advisee) {
                foreach ($subjects as $subject) {
                    $semester = $subject->subject_semester;
                    $subjectId = $subject->subject_id;
                    $subject->advisees()->attach($advisee, ['subject_id' => $subjectId, 'subject_semester' => $semester, 'cs_id' => $intakeId]);
                }
            }
        }        

        $advisees = advisee::all();
        $intakes = course_structure::pluck('cs_intake', 'cs_id');

        session()->flash('success', 'Advisees uploaded successfully!');
        return view('admin.chooseintakeAdvisee', compact('intakes', 'advisees'));   

    }

    public function showadvisee(Request $req)
    {
        $advisees = DB::table('advisees')
            ->where('advisees.cs_id', '=', $req->intake)
            ->get();
            if(Session::has('loginId')){
                return view('admin.advisee', compact('advisees'));
            }
    }

    public function chooseintakeAdvisee() {
        $intakes = course_structure::pluck('cs_intake', 'cs_id');
        if(Session::has('loginId')){
        return view('admin.chooseintakeAdvisee', compact('intakes'));
        }
    }

    public function insertAdvisee(Request $req) {
        $req->validate([
            'intake' => 'nullable',
            'advisee_cgpa' => 'required|numeric|min:0.0|max:4.0',
            'advisee_email' => 'required|email',
            'advisee_postcode' => 'required|numeric',
            'advisee_contact' => 'required|numeric|max_digits:11',
        ]);

        $intakeId = $req->intake;

        if (is_null($intakeId) && !is_null($req->new_intake)) {
            $req->validate([
                'new_intake' => [
                    'required',
                    'unique:course_structures,cs_intake',
                    function ($attribute, $value, $error) {
                        // Check if the input matches the desired format
                        if (!preg_match('/^\d{4}\/\d{2}T\d$/', $value)) {
                            $error('New Intake must be in the format of year/year trimester number (e.g., 2019/20T1).');
                        }
                    },
                ],
            ]);
            $newIntake = $req->new_intake;

            $existingIntake = course_structure::where('cs_intake', $newIntake)->first();

            if ($existingIntake) {
                return back()->with('fail', 'Intake already exists.');
            }

            $intake = new course_structure();
            $intake->cs_intake = $newIntake;
            $intake->save();

            $intakeId = $intake->cs_id;
        } elseif (!is_null($intakeId) && !is_null($req->new_intake)) {
            return back()->with('fail', 'Kindly select OR create a new intake.');
        } elseif (is_null($intakeId) && is_null($req->new_intake)) {
            return back()->with('fail', 'Kindly select or create a new intake before uploading.');
        }

        $exist = advisee::find($req->advisee_id);

        if($exist){
            return back()->with('fail', 'This advisee is already exist.');
        }else{

            $value = new advisee();

            $value->advisee_id = $req->advisee_id;
            $value->advisee_password  = Hash::make($req->advisee_id);
            $value->advisee_fname = $req->advisee_fname;
            $value->advisee_address = $req->advisee_address;
            $value->advisee_town = $req->advisee_town;
            $value->advisee_state = $req->advisee_state;
            $value->advisee_postcode = $req->advisee_postcode;
            $value->advisee_email = $req->advisee_email;
            $value->advisee_contact = $req->advisee_contact;
            $value->advisee_cgpa = $req->advisee_cgpa;
            $value->cs_id = $intakeId;
            $value->save();
            // Get the advisees for the given cs
            $subjects = subject::where('cs_id', $intakeId)->get();
            $advisee = advisee::find($req->advisee_id);

            if ($subjects) {
                // Associate the imported subject with the advisees

                foreach ($subjects as $subject) {
                    $subjectId = $subject->subject_id;
                    $semester = $subject->subject_semester; 
                    $advisee->subjects()->attach($subject, ['subject_id' => $subjectId, 'subject_semester' => $semester, 'cs_id' => $intakeId]);
                }            
            }
            return redirect('/advisee')->with('success', 'Successfully created advisee');
        }
    }

    public function updateAdvisee($advisee_id) {
        $value = advisee::find($advisee_id);
        if(Session::has('loginId')){
            return view('admin.updateAdvisee', ['display'=>$value]);
       }
    }

    public function editAdvisee(Request $req) {
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
                return redirect('/advisee')->with('success', 'Advisee updated successfully');
        
    }

    public function deleteAdvisee($advisee_id) {
        $advisee = advisee::find($advisee_id);
        $advisor = advisor::find($advisee->advisor_id);
    
        // Delete the advisee
        $advisee->delete();
    
        // Decrease the quota of the advisor
        if ($advisor) {
            $advisor->decrement('advisor_quota');
        }
        return redirect('/advisee')->with('success', 'Advisee deleted successfully');
    }
    

    public function importAdvisee(Request $req){
        Excel::import(new AdviseeImport, $req->advisee_file);

        return redirect('/advisee')->with('success', 'File uploaded successfully.');
    }

    public function searchAdvisee() {
    
        $search = $_GET['searchAdvisee'];
    
        $advisee = advisee::where('advisee_id', 'LIKE','%'.$search.'%')
            ->get();
        
        return view('admin.searchAdvisee',['data'=>$advisee]);
    }
    //advisor
    public function insertAdvisor(Request $req) {
        $req->validate([
            'advisor_email' => 'required|email',
            'advisor_ext' => 'required|numeric',
        ]);

        $exist = advisor::find($req->advisor_id);
        if($exist){
            return back()->with('fail', 'This advisor is already exist.');
        } else {

            $value = new advisor();

            $value->advisor_id = $req->advisor_id;
            $value->advisor_password  = Hash::make($req->advisor_id);
            $value->advisor_name = $req->advisor_name;
            $value->advisor_ext = $req->advisor_ext;
            $value->advisor_email = $req->advisor_email;
            $value->advisor_position = $req->advisor_position;
            $value->save();  


            if($req->advisor_position == "Head of Program") {
                $value = new Hop();

                $value->hop_id = $req->advisor_id;
                $value->hop_password = Hash::make($req->advisor_id);
                $value->hop_name = $req->advisor_name;

                $value->save();
            }
            return redirect('/advisor')->with('success', 'Successfully created advisor');
        }
    }

    public function displayAdvisor() {
        $value = advisor::paginate(10);
        if(Session::has('loginId')){
            return view('admin.advisor', ['data'=>$value]);
       }
    }

    public function updateAdvisor($advisor_id) {
        $value = advisor::find($advisor_id);
        if(Session::has('loginId')){
            return view('admin.updateAdvisor', ['display'=>$value]);
       }
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
        $value->advisor_position = $req->advisor_position;
        $value->save();
        return redirect('/advisor')->with('success', 'Advisor updated successfully');
    }

    public function deleteAdvisor($advisor_id)
    {
        $advisor = advisor::find($advisor_id);

        // Get the assigned advisees of the advisor
        $advisees = $advisor->advisees;
        if ($advisees->isNotEmpty()) {
            
            // Remove the advisor_id from the advisees
            foreach ($advisees as $advisee) {
                
                $advisee->advisor_id = null;
                $advisee->advisee_status = "New";
                $advisee->save();
            }
        }

        $advisor->delete();

        return redirect()->back()->with('success', 'Advisor deleted successfully.');
    }


    public function importAdvisor(Request $req)
    {
        $advisorImport = new AdvisorImport();

        $importedAdvisors = Excel::toCollection($advisorImport, $req->advisor_file)->first();

        $importedAdvisorID = $importedAdvisors->pluck('advisor_id')->toArray();
        // Check for duplicate advisors
        $duplicateAdvisors = advisor::whereIn('advisor_id', $importedAdvisorID)
            ->get();

        if ($duplicateAdvisors->isNotEmpty()) {
            return back()->with('fail','Advisors already exist.');
        }
        
        Excel::import($advisorImport, $req->advisor_file);

                $advisors = DB::table('advisors')
                    ->where('advisor_position', 'Head of Program')
                    ->get();

                foreach ($advisors as $advisor) {
                    $value = new Hop();

                    $value->hop_id = $advisor->advisor_id;
                    $value->hop_password = $advisor->advisor_password;
                    $value->hop_name = $advisor->advisor_name;

                    $value->save();
                }
            
        
        return redirect('/advisor')->with('success', 'File uploaded successfully.');
    
    }

    public function searchAdvisor() {
    
        $search = $_GET['searchAdvisor'];
    
        $advisee = advisor::where('advisor_id', 'LIKE','%'.$search.'%')
            ->get();
        
        return view('admin.searchAdvisor',['data'=>$advisee]);
    }

    //subject
    public function displaySubj() {
        $value = subject::paginate(20);
        if(Session::has('loginId')){
             return view('admin.subj', ['data'=>$value]);
        }
    }

    public function createSubj()
    {
        $intakes = course_structure::pluck('cs_intake', 'cs_id');
        if(Session::has('loginId')){
        return view('admin.createSubj', ['intakes' => $intakes]);
        }
    }

    public function insertSubj(Request $req)
    {
        $req->validate([
            'intake' => 'nullable',
            'subject_credithr' => 'required|numeric|min:1|max:10',
            'subject_year' => 'required|numeric|min:1|max:3',
        ]);

        $intakeId = $req->intake;

        if (is_null($intakeId) && !is_null($req->new_intake)) {
            $req->validate([
                'new_intake' => [
                    'required',
                    'unique:course_structures,cs_intake',
                    function ($attribute, $value, $error) {
                        // Check if the input matches the desired format
                        if (!preg_match('/^\d{4}\/\d{2}T\d$/', $value)) {
                            $error('New Intake must be in the format of year/year trimester number (e.g., 2019/20T1).');
                        }
                    },
                ],
            ]);
            $newIntake = $req->new_intake;

            $existingIntake = course_structure::where('cs_intake', $newIntake)->first();

            if ($existingIntake) {
                return back()->with('fail', 'Intake already exists.');
            }

            $intake = new course_structure();
            $intake->cs_intake = $newIntake;
            $intake->save();

            $intakeId = $intake->cs_id;
        } elseif (!is_null($intakeId) && !is_null($req->new_intake)) {
            return back()->with('fail', 'Kindly select OR create a new intake.');
        } elseif (is_null($intakeId) && is_null($req->new_intake)) {
            return back()->with('fail', 'Kindly select or create a new intake before uploading.');
        }

        $exist = subject::where('subject_code', $req->subject_code)
        ->where('cs_id', $intakeId)
        ->first();

        if($exist){
            return back()->with('fail', 'This subject is already exist in this intake.');
        }else{

            $value = new subject();

            $value->subject_code = $req->subject_code;
            $value->subject_year = $req->subject_year;
            $value->subject_semester = $req->subject_semester;
            $value->subject_name = $req->subject_name;
            $value->subject_credithr = $req->subject_credithr;
            $value->subject_category = $req->subject_category;
            $value->subject_prerequisite = $req->subject_prerequisite;
            $value->cs_id = $intakeId;
            $value->save();

            // Associate the subject with the intake if not already associated
            if (!$value->course_structure()->where('course_structures.cs_id', $intakeId)->exists()) {
                $subjectTable = $value->getTable(); // Get the table name for the subjects table
                $subjectPrimaryKey = $value->getKeyName(); // Get the primary key column name for the subjects table

                $courseStructureTable = (new course_structure())->getTable(); // Get the table name for the course_structures table
                $courseStructurePrimaryKey = (new course_structure())->getKeyName(); // Get the primary key column name for the course_structures table
                
                $subjectID = subject::where('subject_code', $req->subject_code)->first();
               
                DB::table('cs_subject')->insert([
                    'subject_id' => $subjectID->subject_id,
                    'cs_id' => $intakeId,
                ]);
            }

            $advisees = advisee::where('cs_id', $intakeId)->get();
            $subject = subject::where('subject_code', $req->subject_code)->first();

            if ($advisees) {
                // Associate the imported subject with the advisees
                foreach ($advisees as $advisee) {
                    $semester = $subject->subject_semester; // Get the subject semester from the subject
                    $subjectID = $subject->subject_id;
                    $advisee->subjects()->attach($subject, ['subject_id'=> $subjectID, 'subject_semester' => $semester, 'cs_id' => $intakeId]);
                }            
            }
            return redirect('/subj')->with('success', 'Successfully created subject');
        }
    }


    public function updateSubj($subject_code) {
        $value = DB::table('subjects')->where('subject_code', $subject_code)->first();
        if(Session::has('loginId')){
            return view('admin.updateSubject', ['display'=>$value]);
       }
    }

    public function editSubj(Request $req) {

        $req->validate([
            'subject_credithr' => 'required|numeric|min:1|max:10',
        ]);

        $value = DB::table('subjects')->where('subject_code', $req->subject_code)->value('subject_id');

        $subject = subject::find($value);
        $subject->subject_code = $req->subject_code;
        $subject->subject_name = $req->subject_name;
        $subject->subject_credithr = $req->subject_credithr;
        $subject->subject_category = $req->subject_category;
        $subject->subject_prerequisite = $req->subject_prerequisite;

        $subject->save();
        return redirect('/subj')->with('success', 'Successfully updated subject');      
    }

    public function deleteSubj($subject_code) {
        DB::delete('delete from subjects where subject_code=?', [$subject_code]);
        return redirect('/subj')->with('success', 'Subject deleted successfully.');
    }

    public function importSubj(Request $req){
        Excel::import(new SubjectImport, $req->subject_file);
        return redirect('/subj')->with('success', 'File uploaded successfully.');
    }

    public function searchSubject() {
    
        $search = $_GET['searchSubject'];
    
        $subject = subject::where('subject_code', 'LIKE','%'.$search.'%')
            ->get();
        if(Session::has('loginId')){
        return view('admin.searchSubject',['data'=>$subject]);
        }
    }

    //hop
    public function displayHOP() {
        $value = hop::all();
        if(Session::has('loginId')){
            return view('admin.hop', ['data'=>$value]);
       }
    }

    public function insertHOP(Request $req) {
        $value = new hop();

        $value->hop_id = $req->hop_id;
        $value->hop_name = $req->hop_name;

        $value->save();
        return redirect('/hop');
    }

    public function deleteHOP($hop_id) {
        DB::delete('delete from hops where hop_id=?', [$hop_id]);
        return redirect('/hop');
    }

    //cs

    public function cs (Request $req){
        
            $value = subject::where('cs_id', '=',$req->intake)
                        ->orderBy('subject_year', 'asc')
                        ->orderBy('subject_semester', 'asc')
                        ->orderBy('subject_category', 'asc')
                        ->get()
                        ->groupBy(['subject_year', 'subject_semester', 'subject_category']);
            $total = DB::table('subjects')->where('cs_id', $req->intake)->sum('subject_credithr');
            if(Session::has('loginId')){
            return view('admin.cs', ['data'=>$value, 'total'=>$total]);
            }
        
    }

    public function displayintake()
    {
        $intakes = course_structure::pluck('cs_intake', 'cs_id');
        if(Session::has('loginId')){
        return view('admin.assignIntake', ['intakes' => $intakes]);
        }
    }


    public function intake(Request $req)
    {
        $req->validate([
            'intake' => 'nullable',
        ]);

        $intakeId = $req->intake;

        if (is_null($intakeId) && !is_null($req->new_intake)) {
         
            $req->validate([
                'new_intake' => [
                    'required',
                    'unique:course_structures,cs_intake',
                    function ($attribute, $value, $error) {
                        // Check if the input matches the desired format
                        if (!preg_match('/^\d{4}\/\d{2}T\d$/', $value)) {
                            $error('New Intake must be in the format of year/year trimester number (e.g., 2019/20T1).');
                        }
                    },
                ],
            ]);
            
            $newIntake = $req->new_intake;

            $existingIntake = course_structure::where('cs_intake', $newIntake)->first();

            if ($existingIntake) {
                return back()->with('error', 'Intake already exists.');
            }

            $intake = new course_structure();
            $intake->cs_intake = $newIntake;
            $intake->save();

            $intakeId = $intake->cs_id;
        }else if (!is_null($intakeId) && !is_null($req->new_intake)){
            return back()->with('error', 'Kindly select OR create new intake.');
        }else if (is_null($intakeId) && is_null($req->new_intake)){
            return back()->with('error', 'Kindly select or create new intake before uploading.');
        }

    $subjectImport = new SubjectImport($intakeId);

    // Get the imported subjects from the Excel file
    $importedSubjects = Excel::toCollection($subjectImport, $req->subject_file)->first();

    // Extract the subject codes from the imported subjects
    $importedSubjectCodes = $importedSubjects->pluck('subject_code')->toArray();
    $subjectIDs= subject::where('subject_code', $importedSubjectCodes)->first();
    // Check for duplicate subjects
    $duplicateSubjects = subject::whereIn('subject_code', $importedSubjectCodes)
         ->where('cs_id', $intakeId)
         ->get();

     if ($duplicateSubjects->isNotEmpty()) {
         return back()->with('error','Some subjects already exist in the intake. Please check the file and remove duplicates.');
     }

    // Iterate over the imported subjects
    foreach ($importedSubjects as $importedSubject) {
        $subjectCode = $importedSubject['subject_code'];
            $value = new subject();
              $value->subject_code = $importedSubject['subject_code'];
              $value->subject_year = $importedSubject['subject_year'];
              $value->subject_semester = $importedSubject['subject_semester'];
              $value->subject_name = $importedSubject['subject_name'];
              $value->subject_credithr = $importedSubject['subject_credithr'];
              $value->subject_category = $importedSubject['subject_category'];
              $value->subject_prerequisite = $importedSubject['subject_prerequisite'];
              $value->cs_id = $intakeId;
              $value->save();

        // Associate the subject with the intake if not already associated
        if (!$value->course_structure()->where('course_structures.cs_id', $intakeId)->exists()) {
            $subjectTable = $value->getTable(); // Get the table name for the subjects table
            $subjectPrimaryKey = $value->getKeyName(); // Get the primary key column name for the subjects table

            $courseStructureTable = (new course_structure())->getTable(); // Get the table name for the course_structures table
            $courseStructurePrimaryKey = (new course_structure())->getKeyName(); // Get the primary key column name for the course_structures table

            $subjectID = subject::where('subject_code', $importedSubject['subject_code'])->first();
            DB::table('cs_subject')->insert([
                'subject_id' => $subjectID->subject_id,
                'cs_id' => $intakeId,
            ]);
        }
        
    }

    $intake = course_structure::find($intakeId);
    $intake->subjects()->attach($subjectIDs);

        // Get the advisees for the given cs
        $advisees = advisee::where('cs_id', $intakeId)->get();

        if ($advisees) {
            $subjectCodes = $subjectImport->getImportedSubjects();
            $subjects = subject::whereIn('subject_code', $subjectCodes)->where('cs_id', $intakeId)->get();

            // Associate the imported subjects with the advisees
            foreach ($advisees as $advisee) {
                foreach ($subjects as $subject) {
                    $semester = $subject->subject_semester; // Get the subject semester from subjects table
                    $advisee->subjects()->attach($subject, ['subject_semester' => $semester, 'cs_id' => $intakeId]);
                    
                }
            }
        }

        return back()->with('success', 'Course Structure uploaded successfully!' );
    }

    public function csintake() {
        $intakes = course_structure::pluck('cs_intake', 'cs_id');
        if(Session::has('loginId')){
        return view('admin.chooseIntake', compact('intakes'));
        }
    }
}
