<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('css')
<style>
  ::placeholder {
    color: black;
  }
  a {
    color:black;
  }
  a:hover {
    color: #A45C40;
    text-decoration:underline ;
    font-weight:bold;
  }
</style>
@include('advisor.navbar')

<body>
<section class="section">

<br><h4 style = 'margin-left: 20px;'>Advisee</h4>
<button class="button" ><a style= 'color:white;background-color:transparent; text-decoration:none' href='/emailall'>Email All</a></button>
<center><div class="container ">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchAdvisee" method="get">
      @if(Session::has('fail'))
        <div class= "alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      <input name="searchAdvisee" type="search" placeholder="Search Advisee" >
      <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
    </div>
</div>

<br><h5 style = 'margin-left: 20px;'>Advisees</h5><br>

@if(count($data) > 0)
<table style='background-color:#F6EEE0' class=table border>
  <tr>
		<th>&nbsp;</th>
    <th>Student ID</th>
    <th>Student Name</th>
    <th>CGPA</th>
    <th>&nbsp;</th>
  </tr>
  @foreach ($data as $display)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td><a href="{{ "adviseeInfo/".$display->advisee_id }}">{{ $display->advisee_id }}</a></td>
    <td><a href="{{ "adviseeInfo/".$display->advisee_id }}">{{ $display->advisee_fname }}</a></td>
    <td><a href="{{ "adviseeInfo/".$display->advisee_id }}">{{ $display->advisee_cgpa }}</a></td>
    <td><center><a style="color:#B67D67; text-decoration:underline" href="{{ "planAdvisee/".$display['advisee_id'] }}">Subject Plan</a></td>
  </tr>
  @endforeach
</table>
@else
  <tr><td style="font-size: 15px">You have no advisees</td></tr>
  @endif
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>