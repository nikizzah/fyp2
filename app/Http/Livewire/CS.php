<?php

namespace App\Http\Livewire;
use DB;

use Livewire\Component;

class CS extends Component
{
    public $years;
    public $sem;
    public $subjects;
    public $intakes;

    public $selectedYear = NULL;
    public $selectedSem = NULL;
    public $selectedIntake = NULL;

    public function mount()
    {
        $this->intakes = DB::table('course_structures')->orderBy('cs_intake', 'asc')->distinct()->pluck('cs_intake');
        $this->years = collect();
        $this->sem = collect();
        $this->subjects = collect(); 
    }

    public function render()
    {
        return view('livewire.c-s');
    }

    public function updatedSelectedIntake($value)
    {
        $cs = DB::table('course_structures')->where('cs_intake', $value)->orderBy('cs_intake', 'asc')->distinct()->pluck('cs_id');
        $this->years = DB::table('subjects')
            ->join('cs_subject', 'subjects.subject_code', '=', 'cs_subject.subject_code')
            ->whereIn('cs_subject.cs_id', $cs)
            ->orderBy('subjects.subject_year', 'asc')
            ->distinct()
            ->pluck('subjects.subject_year');

            }


    public function updatedSelectedYear($value)
    {
        $this->sem = DB::table('subjects')->where('subject_year', $value)->orderBy('subject_semester', 'asc')->distinct()->pluck('subject_semester');
        
    }

    public function updatedSelectedSem($value)
    {
        if(!is_null($this->selectedYear) && !is_null($this->selectedSem)) {
            $subjects = DB::table('subjects')
                ->where('subject_year', $this->selectedYear)
                ->where('subject_semester', $value)
                ->get();

            return redirect()->route('show-subjects')->with('subjects', $subjects);

        }
    }

}
