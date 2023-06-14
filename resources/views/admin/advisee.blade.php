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
@include('admin.navbar')

<body>

<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisee</h4>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/createAdvisee'>Add New Advisee</a></button>
<center><div class="container">
<br>
  <div style = 'margin-left: 800px;'>
    <div class="search">
    <form action="/searchAdminAdvisee" method="get">
        <input name="searchAdvisee" type="search" placeholder="Search Advisee" >
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
    </div>
  </div>
  <br>
	<table class=table border=2>
    <tr>
			<th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th> 
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Address</th>
      <th>Town</th>
      <th>State</th>
      <th>Postcode</th>
      <th>Contact Number</th>
      <th>Email</th>
      <th>CGPA</th>
    </tr>
    @foreach ($advisees as $display)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td><center><a style="color:#B67D67" href="{{ url('delAdvisee/'.$display->advisee_id) }}"><img  class="img-fluid" width="55px" src="{{url('source/images/delete.png')}}" alt="DELETE" ></img></a></td>
      <td><center><a style="color:#B67D67" href="{{ url('updAdvisee/'.$display->advisee_id) }}"><img  class="img-fluid" width="55px" src="{{url('source/images/edit.png')}}" alt="UPDATE" ></img></a></td> 
      <td>{{ $display->advisee_id }}</td>
      <td>{{ $display->advisee_fname }}</td>
      <td>{{ $display->advisee_address }}</td>
      <td>{{ $display->advisee_town }}</td>
      <td>{{ $display->advisee_state }}</td>
      <td>{{ $display->advisee_postcode }}</td>
      <td>{{ $display->advisee_contact }}</td>
      <td>{{ $display->advisee_email }}</td>
      <td>{{ $display->advisee_cgpa }}</td>
    </tr>
    @endforeach

  </table>
  </section>
   @include('script')
</body>
</html>