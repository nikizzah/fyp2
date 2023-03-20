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
<br><h4 style = 'margin-left: 20px;'>Subject</h4>
	
	<div class="container">
	<br>
   <form method="POST" action="/importSubj" enctype="multipart/form-data">
            @if(Session::has('fail'))
                    <div class= "alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
               @csrf
               <div class="form-group" style='text-align:left'>
                  <center><input type="file" id="subject_file" name="subject_file" class="upload-file" required>
                  <!-- <label style="background-color: #F3BB9E; font-size: 20px; width:200px; height: 50px; align-items:center; justify-content:center" for="advisee_file"><span class="material-symbols-outlined">upload_file</span> Choose File</label> -->
					      </div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <center><button type="submit" class="btn btn-primary">Create Subject</button>
				</form>
        <br><br>
	<table class=table border=2>
                  <tr>
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
                      <td>{{$display["subject_code"]}}</td>
                     <td>{{$display["subject_name"]}}</td>
                     <td>{{$display["subject_credithr"]}}</td>
                     <td>{{$display["subject_year"]}}</td>
                     <td>{{$display["subject_semester"]}}</td>
                     <td>{{$display["subject_category"]}}</td>
                     <td>{{$display["subject_prerequisite"]}}</td>
				  </tr>
              @endforeach
              </table>
              <!-- <center><button class="btn btn-primary"><a href='/updateSubject' style='color:black'>Update Subject</a></button> -->

</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>