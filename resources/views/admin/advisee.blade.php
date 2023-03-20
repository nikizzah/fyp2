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

	<div class="container">
	<br>
  <form method="POST" action="/importAdvisee" enctype="multipart/form-data">
      @if(Session::has('fail'))
          <div class= "alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      @csrf
      <div class="form-group" style='text-align:left'>
        <center><input type="file" id="advisee_file" name="advisee_file" class="upload-file" required>
        <!-- <label style="background-color: #F3BB9E; font-size: 20px; width:200px; height: 50px; align-items:center; justify-content:center" for="advisee_file"><span class="material-symbols-outlined">upload_file</span> Choose File</label> -->
				</div>
        <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
        <center><button type="submit" class="btn btn-primary">Create Advisee</button>
	</form>
  <br><br>
	<table class=table border=2>
                  <tr>
				  	     <th>&nbsp;</th>
                    <!-- <th>&nbsp;</th>
                    <th>&nbsp;</th> -->
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
                    <!-- <td><center><a style="color:#B67D67" href = {{"delAdvisee/".$display['advisee_id']}}>DELETE</a></td>
                    <td><center><a style="color:#B67D67" href = {{"updAdvisee/".$display['advisee_id']}}>UPDATE</a></td> -->
                    <td>{{$display["advisee_id"]}}</td>
                    <td>{{$display["advisee_fname"]}}</td>
                    <td>{{$display["advisee_address"]}}</td>
                    <td>{{$display["advisee_town"]}}</td>
                    <td>{{$display["advisee_state"]}}</td>
                    <td>{{$display["advisee_postcode"]}}</td>
                    <td>{{$display["advisee_contact"]}}</td>
                    <td>{{$display["advisee_email"]}}</td>
                    <td>{{$display["advisee_cgpa"]}}</td>
				  </tr>
              
              @endforeach
              </table>
             <!-- <center><button class="btn btn-primary" ><a href='/updateAdvisee' style='color:black'>Update Advisee</a></button> -->
   </section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>