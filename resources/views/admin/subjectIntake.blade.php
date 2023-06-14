

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
<br><h4 style = 'margin-left: 20px;'>Subject</h4>

	<div class="container">
	<br>
   <form method="POST" action="/assignIntake" enctype="multipart/form-data">
      @if(Session::has('error'))
        <div class= "alert alert-danger">{{Session::get('error')}}</div>
      @elseif(Session::has('success'))
        <div class= "alert alert-success">{{Session::get('success')}}</div>
      @endif
      @csrf
      <div class="form-group" style='text-align:left'>
			<label for="intake">Intake:</label>
			<select style="color:black; border:#E4B7A0; width: 500px;" name="intake" type="text" class="form-control ">
        <option value="" disabled="true" selected= "true">Select Intake</option>  
        @foreach ($intake as $assign) 
        <option value= "{{$assign['cs_id']}}">{{$assign['cs_intake']}}</option>
        @endforeach   
      </select>
			</div>

      <div class="form-group" style='text-align:left'>
        <center><input type="file" id="subject_file" name="subject_file" class="upload-file" required>
			</div>
          <center><button type="submit" class="btn btn-primary">Assign Intake</button>
		</form>
  <br><br>
	
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>