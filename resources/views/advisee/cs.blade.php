<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">
@include('css')
@include('advisee.navbar')

<body>

<section class="section">
<br><h4 style = 'margin-left: 20px;'>Course Structure</h4>
<button class="button" ><a style= 'color:black'>Overall Credit Hours: {{$total}}</a></button>
<br>
<center><h4>LOCAL BACHELOR OF COMPUTER SCIENCE (SOFTWARE ENGINEERING) (HONS.)</h4>
<br>

@foreach($data as $year => $semesters)
    <h4>YEAR {{ $year }}</h4>
    <div class="container containerCS">
    @foreach ($semesters as $semester => $categories)
    @if($semester != "To be chosen")
        <h4>{{ $semester }}</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Credit Hour</th>
                    <th>Subject Category</th>
                    <th>Pre-requisite</th>
                </tr>
            </thead>

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
<br>
@endforeach
<br>

	<div class="container containerELECTIVE">
    <center><h4>LIST OF <a style="color:#FF0000; font-weight:900px">TECHNICAL ELECTIVE</a> SUBJECTS (FOCUS AREA)</h4>
    @foreach($data as $year => $semesters)
    @foreach($semesters as $semester => $categories)
    @foreach($categories as $category => $subjects)
    @if ($semester == "To be chosen")
    
    <br>
    <h4>{{ $category }}</h4>
	<br><table class=table border=2 style="border-color:black"> 
            <thead>
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Pre requisite</th>
                  </tr>
            </thead>
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

   </section>

   <!-- JS Plugins -->
    @include('script')

</body>
</html>