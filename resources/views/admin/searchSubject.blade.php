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
<br><h4 style = 'margin-left: 20px;'>Subject</h4>
<button class="button" ><a style= 'color:black' href='/subj'>Back</a></button>
<center><div class="container">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchAdminSubject" method="get">
        <input name="searchSubject" type="search" placeholder="Search Subject" >
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
        </div>
</div>

@if(isset($data))<br>
<table style='background-color:#F6EEE0' class=table border>

  @if(count($data) > 0)
  <tr>
		<th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th> 
    <th>Subject Code</th>
    <th>Subject Name</th>
    <th>Credit Hour</th>
    <th>Subject Year</th>
    <th>Subject Semester</th>
    <th>Subject Category</th>
    <th>Pre requisite</th>
  </tr>
  @foreach ($data as $display)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td><center><a style="color:#B67D67" href = {{"delSubj/".$display['subject_code']}}><img class="img-fluid" width="35px" src="{{url('source/images/delete.png')}}" alt="DELETE"></img></a></td>
    <td><center><a style="color:#B67D67" href = {{"updSubj/".$display['subject_code']}}><img  class="img-fluid" width="35px" src="{{url('source/images/edit.png')}}" alt="UPDATE"></img></a></td> 
    <td>{{$display["subject_code"]}}</td>
    <td>{{$display["subject_name"]}}</td>
    <td>{{$display["subject_credithr"]}}</td>
    <td>{{$display["subject_year"]}}</td>
    <td>{{$display["subject_semester"]}}</td>
    <td>{{$display["subject_category"]}}</td>
    <td>{{$display["subject_prerequisite"]}}</td>
	</tr>
  @endforeach
@else
  <tr><td style="font-size: 15px">No result found!</td></tr>
@endif   
</table>
@endif

</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>