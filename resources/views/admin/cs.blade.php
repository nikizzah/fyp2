<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">
@include('css')
@include('admin.navbar')

<body>

<section class="section">
<br><h4 style = 'margin-left: 20px;'>Course Structure</h4>
<button class="button" ><a style= 'color:black ;background-color:transparent; text-decoration:none'>Overall Credit Hours: {{$total}}</a></button><br>

<br>
<center><h4>LOCAL BACHELOR OF COMPUTER SCIENCE (SOFTWARE ENGINEERING) (HONS.)</h4>
<br>
@if(count($data) > 0)
@foreach($data as $year => $semesters)
    <h4>YEAR {{ $year }}</h4>
    <div class="container containerCS">
    @foreach ($semesters as $semester => $categories)
    @if($semester != "To be chosen")
        <h4>{{ $semester }}</h4>
        <table class="table">
            <th>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Credit Hour</th>
                    <th>Subject Category</th>
                    <th>Pre-requisite</th>
                </tr>
            </th>

            <tbody>
            @foreach($categories as $category => $subjects)
                @foreach($subjects as $subject)
                    @if($semester != "To be chosen" && $category != "Technical Elective")
                    <tr>
                        <td>{{ $subject->subject_code }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        <td>{{ $subject->subject_credithr }}</td>
                        <td>{{ $subject->subject_category }}</td>
                        <td>{{ $subject->subject_prerequisite }}</td>
                    </tr>
                    @endif 
                    @if($semester != "To be chosen" && $category == "Technical Elective")
                    <tr>
                        <td style ="color:#A45C40">{{ $subject->subject_code }}</td>
                        <td style ="color:#A45C40">{{ $subject->subject_name }}</td>
                        <td style ="color:#A45C40">{{ $subject->subject_credithr }}</td>
                        <td style ="color:#A45C40">{{ $subject->subject_category }}</td>
                        <td style ="color:#A45C40">{{ $subject->subject_prerequisite }}</td>
                    </tr>
                    @endif 
                @endforeach
            @endforeach
            </tbody>
        </table>
        @endif 
        @endforeach
</div>
@endforeach
<br>

	<div class="container containerELECTIVE">
    <center><h4>LIST OF <a style="color:#FF0000; font-weight:900px">ELECTIVE</a> SUBJECTS</h4>
    @foreach($data as $year => $semesters)
    @foreach($semesters as $semester => $categories)
    @foreach($categories as $category => $subjects)
    @if ($semester == "To be chosen")
    
    <br>
    <h4>{{ $category }}</h4>
	<br><table class=table border=2 style="border-color:black"> 
        <th>
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Pre requisite</th>
            </tr>
        </th>
        <tbody>
            @foreach($subjects as $subject)
            @if ($semester == "To be chosen")
            <tr>
                <td>{{ $subject->subject_code }}</td>
                <td>{{ $subject->subject_name }}</td>
                <td>{{ $subject->subject_prerequisite }}</td>
            </tr>
            @endif 
            @endforeach
        </tbody>
    </table>
    @endif 
    @endforeach
    @endforeach
    @endforeach
</div>
@else
    <tr><td style="font-size: 25px; color: red"><h4 style="color: red">No subjects in this intake!</h4></td></tr>
@endif

   </section>

   <!-- JS Plugins -->
    @include('script')

</body>
</html>