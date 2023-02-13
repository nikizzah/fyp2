<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\advisee;
use App\Models\advisor;
use App\Models\hop;
use App\Models\subject;

class adminControl extends Controller
{
    public function displayAdvisee() {
        $value = advisee::all();
        return view('admin.advisee', ['data'=>$value]);
    }

    public function deleteAdvisee($advisee_id) {
        DB::delete('delete from advisees where advisee_id=?', [$advisee_id]);
        return redirect('/advisee');
    }

    public function displayAdvisor() {
        $value = advisor::all();
        return view('admin.advisor', ['data'=>$value]);
    }

    public function deleteAdvisor($advisor_id) {
        DB::delete('delete from advisors where advisor_id=?', [$advisor_id]);
        return redirect('/advisor');
    }

    public function displaySubj() {
        $value = subject::all();
        return view('admin.subj', ['data'=>$value]);
    }

    public function deleteSubj($subject_code) {
        DB::delete('delete from subjects where subject_code=?', [$subject_code]);
        return redirect('/subj');
    }

    public function displayHOP() {
        $value = hop::all();
        return view('admin.hop', ['data'=>$value]);
    }

    public function deleteHOP($hop_id) {
        DB::delete('delete from hops where hop_id=?', [$hop_id]);
        return redirect('/hop');
    }
}
