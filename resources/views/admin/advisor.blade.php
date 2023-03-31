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
<!-- navigation -->

<!-- /navigation -->


<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisor</h4>
   
	<div class="container">
	<br>
   <form method="POST" action="/importAdvisor" enctype="multipart/form-data">
            @if(Session::has('fail'))
                    <div class= "alert alert-danger">{{Session::get('fail')}}</div>
                    @elseif(Session::has('success'))
                    <div class= "alert alert-success">{{Session::get('success')}}</div>
                    @endif
               @csrf
               <div class="form-group" style='text-align:left'>
                  <center><input type="file" id="advisor_file" name="advisor_file" class="upload-file" required>
                  <!-- <label style="background-color: #F3BB9E; font-size: 20px; width:200px; height: 50px; align-items:center; justify-content:center" for="advisee_file"><span class="material-symbols-outlined">upload_file</span> Choose File</label> -->
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <center><button type="submit" class="btn btn-primary">Create Advisor</button>
				</form>
        <br><br>
	      <table class=table border=2>
                  <tr>
				  	<th>&nbsp;</th>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Extension</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Quota</th>
                  </tr>
                  @foreach ($data as $display)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{$display["advisor_id"]}}</td>
                     <td>{{$display["advisor_name"]}}</td>
                     <td>{{$display["advisor_ext"]}}</td>
                     <td>{{$display["advisor_email"]}}</td>
                     <td>{{$display["advisor_position"]}}</td>
                     <td>{{$display["advisor_quota"]}}</td>
				  </tr>
              @endforeach
              </table>
              <!-- <center><button class="btn btn-primary" ><a href='/updateAdvisor' style='color:black'>Update Advisor</a></button> -->


</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>