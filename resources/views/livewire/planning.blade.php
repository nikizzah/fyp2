<div class="container containerPLAN">
    @if (!is_null($subjects))
        <div class="subject-list">
            @if ($prerequisiteError)
               <center> <div class="text-red-500" style ="color:red; font-size:20px; font-weight:bold">{{ $prerequisiteError }}</div>
            @endif
            @if ($internError)
               <center> <div class="text-red-500" style ="color:red; font-size:20px; font-weight:bold">{{ $internError }}</div>
            @endif
            @foreach ($subjects as $semester => $semesterSubjects)
            @if ($semester != "To be chosen")
                    <center><h4>{{ $semester }}</h4>
                    @foreach ($semesterSubjects as $index => $subject)
                    <table class="table" id="{{ $semester }}" style="max-width: 5000px; ">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Subject Semester</th>
                                <th>Subject Category</th>
                                <th>Pre-requisite</th>
                                <th>Credit Hour</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subject['subject_semester'] != "To be chosen")
                            <tr
                                draggable="true"
                                data-subject-code="{{ $subject['subject_code'] }}"
                                data-prerequisite="{{ $subject['subject_prerequisite'] }}"
                                data-name="{{ $subject['subject_name'] }}"
                                x-data="{ dragging: false }"
                                x-interact
                                x-on:dragstart="dragging = true"
                                x-on:dragend="dragging = false"
                                x-init="
                                    interact(this)
                                        .draggable({
                                            onstart: () => dragging = true,
                                            onend: () => dragging = false,
                                            allowFrom: '.draggable-handle',
                                        })
                                        .on('dragmove', (event) => {
                                            const targetTable = event.target.closest('.table');
                                            const subjectCode = event.target.dataset.subjectCode;

                                            // Update the subject's semester in the Livewire component
                                            @this.call('updateSubjectSemester', subjectCode, targetTable.id);
                                        });
                                "
                                :class="{ 'dragging': dragging }"
                                wire:key="subject-{{ $subject['subject_code'] }}"
                            >
                                <td><center><a><img  class="img-fluid" width="55px" src="{{url('source/images/drag.png')}}" alt="DRAG"></img></a></td>
                                <td class="draggable-handle">{{ $subject['subject_code'] }}</td>
                                <td class="name">{{ $subject['subject_name'] }}</td>
                                <td>{{ $subject['pivot']['subject_semester'] }}</td>
                                <td>{{ $subject['subject_category'] }}</td>
                                <td class="prerequisite">{{ $subject['subject_prerequisite'] }}</td>
                                <td>{{ $subject['subject_credithr'] }}</td>
                                <td style="width: 80px;">
                                <center>
                                    @if ($subject['subject_name'] != "Industrial Training" && $subject['subject_semester'] != "To be chosen")
                                    <select style="color:white; border:#E4B7A0; padding:5px; background-color:#c88f73; text-align:center" 
                                        name="grade[{{ $subject['subject_code'] }}]"
                                        wire:model="selectedGrades.{{ $subject['subject_code'] }}"
                                        wire:change="updateGrade('{{ $subject['subject_code'] }}', $event.target.value, '{{ $semester }}')"
                                    >
                                        <option value="" selected>Grade</option>  
                                        <option value="4.00">A+ / A</option>
                                        <option value="3.67">A-</option>
                                        <option value="3.33">B+</option>
                                        <option value="3.00">B</option>
                                        <option value="2.67">B-</option>
                                        <option value="2.33">C+</option>
                                        <option value="2.00">C</option>
                                        <option value="1.67">C-</option>
                                        <option value="1.33">D+</option>
                                        <option value="1.00">D</option>
                                        <option value="0.00">E</option>
                                    </select>
                                    @endif
                                </center>
                                </td>
                            </tr>
                            @endif
                            @endforeach 
                        </tbody>
                    </table>

<div style="color:#A45C40; font-weight:bold; text-align: right;">
    <span style="margin-right: 25px;">Total Credit Hour:</span>
    <span style="margin-right: 12px;">{{ collect($semesterSubjects)->sum('subject_credithr') }} </span>
</div>
<div style="color:#A45C40; font-weight:bold; text-align: right;">
    <span style="margin-right: 25px;">GPA:</span>
    <span style="margin-right: 12px;" class="gpa" id="{{ $semester }}">{{ $semesterGPAs[$semester] ?? '' }}</span>
</div>
<div style="color:#A45C40; font-weight:bold; text-align: right;">
    <span style="margin-right: 25px;">CGPA:</span>
    <span style="margin-right: 12px;" class="cgpa" id="{{ $semester }}">{{ $semesterCGPAs[$semester] ?? 'N/A' }}</span>
</div>
@if (isset($semesterCGPAs[$semester]) && $semesterCGPAs[$semester] >= 3.5 && collect($semesterSubjects)->sum('subject_credithr') >= 12)
    <div style="font-weight:bold; text-align: right;">
        <button style="border:none; color:white; background-color:#62A464; margin-right: 12px;">Dean's List</button>
    </div>
@elseif ($consecutiveLowCGPA)
    <div style="font-weight:bold; text-align: right; ">
        <button class="blinking-button" style="color:white; background-color:#BB1E14; border:none; ; margin-right: 12px;">Probation! CGPA < 2.0</button>
    </div>
@endif
@endif
@endforeach
</div>
@else
    <p>No data available.</p>
@endif
</div>