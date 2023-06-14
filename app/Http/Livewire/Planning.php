<?php

namespace App\Http\Livewire;

use App\Models\advisee;
use App\Models\subject;
use DB;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Planning extends Component
{
    public $year;
    public $subjects;
    public $selectedGrades = [];
    public $semesterGPAs = [];
    public $semesterCGPAs = [];
    protected $listeners = [
        'updateSubjectSemester',
        'displayPrerequisiteError',
        'clearPrerequisiteError',
        'displayInternError'
    ];

    public $prerequisiteError = '';
    public $internError = '';

    public function displayPrerequisiteError($errorMessage)
    {
        $this->prerequisiteError = $errorMessage;
    }

    public function displayInternError($errorIntern){
        $this->internError = $errorIntern;
    }


    public function mount()
    {
        $this->loadSubjects();
    }

    public function loadSubjects()
    {
        $adviseeId = session()->get('adviseeloginId');
        $advisee = advisee::find($adviseeId);
        if ($advisee) {

            $adviseeSubjects = $advisee->subjects()

                ->withPivot('subject_semester')
                ->orderBy('subject_semester')
                ->distinct()
                ->get();
            $groupedSubjects = [];

            foreach ($adviseeSubjects as $subject) {
                $semester = $subject->pivot->subject_semester;

                if (!isset($groupedSubjects[$semester])) {
                    $groupedSubjects[$semester] = [];
                }

                $groupedSubjects[$semester][] = $subject->toArray();

                // Initialize the selected grades array
                $this->selectedGrades[$subject->subject_code] = $subject->pivot->subject_grade ?? '';
            }

            $this->subjects = $groupedSubjects;

        }
    }

    public function updateSubjectSemester($subjectId, $sourceSemesterId, $targetSemesterId)
    {
        // Retrieve the advisee and the subject
        $adviseeId = session()->get('adviseeloginId');
        $advisee = advisee::find($adviseeId);
        $subjectid = subject::where('subject_code', '=', $subjectId)->value('subject_id');
        $subject = $advisee->subjects()->where('advisee_subject.subject_id', $subjectid)->first();

        if ($subject) {
            // Update the subject's semester
            $subject->pivot->subject_semester = $targetSemesterId;
            $subject->pivot->subject_grade = $this->selectedGrades[$subjectId] ?? null;
            $subject->pivot->save();

            $this->loadSubjects();

        }
    }

    private function getPreviousSemester($semester)
    {
        // Extract the semester number from the input semester string
        preg_match('/Semester\s*(\d+)/i', $semester, $matches);
        $semesterNumber = (int) $matches[1];
    
        // Calculate the previous semester number
        $previousSemesterNumber = $semesterNumber - 1;
        $adviseeId = session()->get('adviseeloginId');
        $intake = advisee::where('advisee_id', $adviseeId)->value('cs_id');
        // Check if the previous semester has "(Special Sem)" in the subjects table
        $hasSpecialSem = subject::where('cs_id', $intake)->where('subject_semester', 'Semester ' . $previousSemesterNumber . ' (Special Sem)')->exists();
    
        // Generate the previous semester name based on the existence of "(Special Sem)"
        if ($hasSpecialSem) {
            return 'Semester ' . $previousSemesterNumber . ' (Special Sem) ';
        } else {
            return 'Semester ' . $previousSemesterNumber;
        }
    }

    private function getNextSemester($semester)
    {
        // Extract the semester number from the input semester string
        preg_match('/Semester\s*(\d+)/i', $semester, $matches);
        $semesterNumber = (int) $matches[1];
    
        // Calculate the next semester number
        $nextSemesterNumber = $semesterNumber + 1;
        $adviseeId = session()->get('adviseeloginId');
        $intake = advisee::where('advisee_id', $adviseeId)->value('cs_id');
        // Check if the next semester has "(Special Sem)" in the subjects table
        $hasSpecialSem = subject::where('cs_id', $intake)->where('subject_semester', 'Semester ' . $nextSemesterNumber . ' (Special Sem)')->exists();
    
        // Generate the next semester name based on the existence of "(Special Sem)"
        if ($hasSpecialSem) {
            return 'Semester ' . $nextSemesterNumber . ' (Special Sem) ';
        } else {
            return 'Semester ' . $nextSemesterNumber;
        }
    }
       

    public function updateGrade($subjectCode, $grade, $semesterName)
    {
        $this->selectedGrades[$subjectCode] = $grade;

        $this->calculateSemesterGPA($semesterName);
    }

    public function calculateSemesterGPA($semester)
    {
        $semesterCGPAs = session()->get('semesterCGPAs', []);
        $subjects = $this->subjects[$semester] ?? [];

        $totalCredits = 0;
        $totalQualityPoints = 0;

        foreach ($subjects as $subject) {
            $subjectCode = $subject['subject_code'];
            $creditHour = $subject['subject_credithr'];
            $grade = floatval($this->selectedGrades[$subjectCode] ?? 0);

            $qualityPoints = $grade * $creditHour;

            $totalCredits += $creditHour;
            $totalQualityPoints += $qualityPoints;
        }

        if ($totalCredits > 0) {
            $gpa = $totalQualityPoints / $totalCredits;
        } else {
            $gpa = 0;
        }

        // Update the GPA for the specific semester
        $this->semesterGPAs[$semester] = round($gpa, 2);

        // Calculate CGPA
        $totalSemesters = count($this->semesterGPAs);
        $cgpa = 0;

        $adviseeId = session()->get('adviseeloginId');
        $intake = advisee::where('advisee_id', $adviseeId)->value('cs_id');

        // Get the first semester in year 1
        $firstSemester = DB::table('subjects')
            ->where('cs_id', $intake)
            ->orderBy('subject_year')
            ->orderBy('subject_semester')
            ->value('subject_semester');

        $semesters = trim($semester);

        $internSemester = DB::table('subjects')
            ->where('subject_name', '=', 'Industrial Training')
            ->pluck('subject_semester')
            ->first();

        $previousSemester = $this->getPreviousSemester($semesters);
        $previousSemester = trim($previousSemester);
        $nextSemester = $this->getNextSemester($semesters);
        $nextSemester = trim($nextSemester);


        if ($previousSemester == $internSemester ) {
            // Extract the semester number from the input semester string
            preg_match('/Semester\s*(\d+)/i', $internSemester, $matches);
            $semesterNumber = (int) $matches[1];
        
            // Calculate the previous semester number
            $intern = $semesterNumber - 1;
        
            // Check if the previous semester has "(Special Sem)" in the subjects table
            $hasSpecialSem = subject::where('subject_semester', 'Semester ' . $intern . ' (Special Sem)')->exists();
        
            // Generate the previous semester name based on the existence of "(Special Sem)"
            if ($hasSpecialSem) {
                $beforeIntern = 'Semester ' . $intern . ' (Special Sem) ';
            } else {
                $beforeIntern =  'Semester ' . $intern;
            }
        }
        // Check if the first semester's CGPA has been calculated
        $isFirstSemesterCalculated = isset($this->semesterCGPAs[$firstSemester]);

        if (isset($this->semesterCGPAs[$previousSemester])) {
            $previousSemesterCGPA = $this->semesterCGPAs[$previousSemester];
        } 

        preg_match('/Semester\s*(\d+)/i', $semester, $matches);
        $semesterNumber = (int) $matches[1];

        if ($semesters == $firstSemester) {
            // If it's the first semester in year 1, set CGPA equal to GPA
            $cgpa = $gpa;
            $this->semesterGPAs[$semester] = round($cgpa, 2);
            $this->semesterCGPAs[$semesters] = round($cgpa, 2);
        } elseif ($previousSemester == $internSemester && isset($this->semesterCGPAs[$beforeIntern])){ // for after intern
            $totalGPAs = array_sum($this->semesterGPAs);
            $cgpa = $totalGPAs / $totalSemesters;
            $this->semesterCGPAs[$semesters] = round($cgpa, 2);
        }elseif ($semester == $internSemester && isset($this->semesterCGPAs[$previousSemester])){ // for intern
            $cgpa = $this->semesterCGPAs[$previousSemester];
            $this->semesterCGPAs[$semesters] = round($cgpa, 2);
        }elseif ($firstSemester == $previousSemester && $isFirstSemesterCalculated) { //check 2nd semester
            $totalGPAs = $this->semesterGPAs[$firstSemester] + $this->semesterGPAs[$semester];
            $cgpa = $totalGPAs / $semesterNumber;
            $this->semesterCGPAs[$semesters] = round($cgpa, 2);
        } elseif (isset($this->semesterCGPAs[$nextSemester])) { //check if next semester has CGPA
            $totalGPAs = 0;
            $totalSemesters = 0;
            for ($i = $semesterNumber; $i > 0; $i--) {
                $semesterKey = "Semester " . $i;

                $hasSpecialSem = subject::where('subject_semester', 'Semester ' . $i . ' (Special Sem)')->exists();
                // Generate the previous semester name based on the existence of "(Special Sem)"
                if ($hasSpecialSem) {
                    $semesterKey = 'Semester ' . $i . ' (Special Sem) ';
                    $semesterKey = trim($semesterKey);
                }
                
                if (isset($this->semesterGPAs[$semesterKey])) {
                    $totalGPAs += $this->semesterGPAs[$semesterKey];
                    $totalSemesters++;
                }
            }

            $cgpa = $totalGPAs / $totalSemesters;
            $this->semesterCGPAs[$semesters] = round($cgpa, 2);
        }elseif (isset($this->semesterCGPAs[$previousSemester])) { //check if previous semester has CGPA
            $totalGPAs = array_sum($this->semesterGPAs);
            $cgpa = $totalGPAs / $totalSemesters ;
            $this->semesterCGPAs[$semesters] = round($cgpa, 2);
        } else {
             $cgpa = 'N/A';
        }

        session()->put('semesterCGPAs', $this->semesterCGPAs);
        // Emit an event to update the GPA and CGPA display in the JavaScript code
        $this->emit('gpaCalculated', $semester, $gpa, $cgpa);
    }

    public function render()
    {
        $semesterCGPAs = session()->get('semesterCGPAs', []);

        $lowCGPACount = 0;
        $previousSemester = null;
        $previousSemesterCGPA = null;
        $ignoreShortSemester = false;

        foreach ($semesterCGPAs as $semester => $cgpa) {
            // Check if the semester name contains "Special Sem"
            if (strpos($semester, 'Special Sem') !== false) {
                // Skip this semester as it is a short semester
                continue;
            }

            if ($cgpa < 2.0 ) {
                $previousSemester = $this->getPreviousSemester($semester);
                $previousSemester = trim($previousSemester);
                if (strpos($previousSemester, 'Special Sem') !== false && $previousSemesterCGPA > 2.0) {
                    // The advisee has not been getting below 2.0 CGPA consecutively
                    $lowCGPACount = 0;
                }
                if (strpos($previousSemester, 'Special Sem') !== false ) {
                    // The advisee has not been getting below 2.0 CGPA consecutively
                    $lowCGPACount = 0;
                }

                $lowCGPACount++;
                $previousSemester = $semester;
                $previousSemesterCGPA = $cgpa;

                if ($lowCGPACount >= 2) {
                    // The advisee has been getting below 2.0 CGPA for two consecutive semesters
                    $consecutiveLowCGPA = true;
                    break;
                }
            } else {
                $previousSemester = null;
                $previousSemesterCGPA = null;
            }
        }

        $consecutiveLowCGPA = $lowCGPACount >= 2;

        // Check if all semesters have CGPAs greater than or equal to 2.0
        $allSemestersPassed = !$consecutiveLowCGPA;

        return view('livewire.advisor-plan', [
            'consecutiveLowCGPA' => $consecutiveLowCGPA,
            'allSemestersPassed' => $allSemestersPassed,
        ]);
    }

}