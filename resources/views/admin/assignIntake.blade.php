

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
<br><h4 style = 'margin-left: 20px;'>Course Structure</h4>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/csintake'>View Course Structure</a></button>
	<div class="container">
	<br>

      <br><center><h4 style = 'margin-left: 20px; '>Create or Select Intake </h4></center><br>
      @if(session('success'))
         <div style="width: 600px;margin-left:250px" class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if(session('error'))
         <div style="width: 600px;margin-left:250px" class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <form action="/importIntake" method="POST" enctype="multipart/form-data">
      @csrf
         <!-- Display list of available intakes -->
         <div class="form-group">
         <label style="margin-left:250px" for="intake">Select Existing Intake:</label>
         <select style = "width: 600px;margin-left:250px" class="form-control" name="intake" id="intake">
            <option value="">Select Intake</option>
            @foreach($intakes as $intakeId => $intake)
               <option value="{{ $intakeId }}">{{ $intake }}</option>
            @endforeach
         </select>
         </div>

         <div class="form-group">
            <label style="margin-left:250px" for="new_intake">New Intake:</label>
            <input style = "width: 600px; margin-left:250px" type="text" class="form-control" name="new_intake" id="new_intake" placeholder="e.g., 2019/20T1"></input>
            <span style="margin-left:250px"class="text-danger">@error('new_intake')  {{$message}} @enderror</span>
         </div>
         <div class="form-group" style='text-align:left'>
            <label style="margin-left:254px" for="upload_cs">Upload Subject: <a style="color:red">*</a></label>
            <center><input type="file" id="subject_file" name="subject_file" class="upload-file" required>
         </div>
            <center><button type="submit" class="btn btn-primary">Upload Course Structure</button>
      </form>

</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>