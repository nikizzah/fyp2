<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('css')
<head>
<style>
    ::placeholder {
    color: black;
  }
  a {
    color:black;
  }
  a:hover {
    color: #A45C40;
    font-style:italic ;
    font-weight:bold;
  }
</style>
</head>
@include('hop.navbar')

<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisee</h4>
<button class="button" ><a style= 'color:black' href='/chooseadvisee'>Back</a></button>
<center><div class="container">
<div style = 'margin-left: 700px;'>
    <form action="/searchAssignedAdvisee" method="get">
    <input style="border:none; background-color: transparent;" type="hidden" name="intake" value="{{$intake}}" readonly onfocus="this.style.border = 'none'; this.style.outline = 'none';">
    <div class="search">
        <input style= 'background-color:transparent; text-decoration:none; font-weight:normal' name="searchAssignedAdvisee" type="search" placeholder="Search Advisee" required>
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
   </div>
    </form>
</div>
<br><h5 style = 'margin-left: 20px;'>Assigned Advisee -  <a style ="color:#A45C40;  font-style:normal">Intake {{$intake}}</a></h5><br>

@if(isset($assigned))
  <table style='background-color:#F6EEE0' class=table border>
    @if(count($assigned) > 0)
    <tr>
			<th>&nbsp;</th>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Assigned Advisor</th>
    </tr>
    @foreach ($assigned as $assign)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td><a href = {{"infoAssigned/".$assign->advisee_id}}>{{$assign->advisee_id}}</td>
      <td><a  href = {{"infoAssigned/".$assign->advisee_id}}>{{$assign->advisee_fname}}</td>
      <td>{{$assign->advisor_name}}</td>
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