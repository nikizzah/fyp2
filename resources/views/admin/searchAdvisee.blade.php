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
<br><h4 style = 'margin-left: 20px;'>Advisee</h4>
<button class="button" ><a style= 'color:black' href='/advisee'>Back</a></button>
<center><div class="container">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchAdminAdvisee" method="get">
        <input name="searchAdvisee" type="search" placeholder="Search Advisee" >
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
        </div>
</div>
<br><h5 style = 'margin-left: 20px;'>Advisee</h5><br>

@if(isset($data))
<table style='background-color:#F6EEE0' class=table border>
    @if(count($data) > 0)
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
    @foreach ($data as $display)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><center><a style="color:#B67D67" href="{{ url('delAdvisee/'.$display->advisee_id) }}"><img  class="img-fluid" width="20px" src="{{url('source/images/delete.png')}}" alt="DELETE"></img></a></td>
        <td><center><a style="color:#B67D67" href="{{ url('updAdvisee/'.$display->advisee_id) }}"><img  class="img-fluid" width="20px" src="{{url('source/images/edit.png')}}" alt="UPDATE"></img></a></td> 
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