<?php

namespace App\Http\Livewire;
use DB;

use Livewire\Component;

class AdviseeCS extends Component
{
    public $years;
    public $subjects;
    public $intakes;

    public $selectedYear = NULL;
    public $selectedIntake = NULL;

    public function mount()
    {
        $this->intakes = DB::table('course_structures')->orderBy('cs_intake', 'asc')->distinct()->pluck('cs_intake');
        $this->years = collect();
        $this->sem = collect();
        $this->subjects = collect(); // initialize $subjects as an empty collection
    }

    public function render()
    {
        return view('livewire.advisee-c-s');
    }

    public function updatedSelectedIntake($value)
    {
        $cs = DB::table('course_structures')->where('cs_intake', $value)->orderBy('cs_intake', 'asc')->distinct()->pluck('cs_id');
        $this->years = DB::table('subjects')->where('cs_id', $cs)->orderBy('subject_year', 'asc')->distinct()->pluck('subject_year');
        
    }


    public function updatedSelectedYear($value)
    {
        if (!is_null($this->selectedYear)) {
            $subjects = DB::table('subjects')
                ->where('subject_year', $value)
                ->orderBy('subject_semester', 'asc')
                ->get()
                ->groupBy('subject_semester');
                
            return redirect()->route('show-planning')->with('subjects', $subjects);
        }
    }
}
