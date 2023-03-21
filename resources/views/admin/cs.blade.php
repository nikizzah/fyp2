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
<button class="button" ><a style= 'color:black' href='/uploadCourseStructure'>Upload Course Structure</a></button>
	<div class="container">
	<br>


  <form method="POST" action="/chooseCS">
    @csrf
    <div class="form-group" style='text-align:left'>
		<label for="name">Year: </label>
     <!-- 1. choose year -->
    <select style="color:#E4B7A0; border:#E4B7A0" name="year" type="text" class="form-control ">
      <option value="">Select Year</option>  
      @foreach ($data as $year) 
      <option value= "{{$year->subject_year}}">{{$year->subject_year}}</option>
      @endforeach   
      </select> <br>
    <!-- 2. choose semester -->
    <label for="name">Semester: </label>
    <select style="color:#E4B7A0; border:#E4B7A0" name="semester" type="text" class="form-control ">
    <option value="">Select Semester</option>  
    @foreach ($data as $sem) 
    <option value= "{{$sem->subject_semester}}">{{$sem->subject_semester}}</option>
    @endforeach   
    </select>

		</div>
    <center><button type="submit" class="btn btn-primary">Confirm</button><br>
	</form>


	<br><table class=table border=2>
                  <tr>
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
                  
              </table>
              
   </section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>