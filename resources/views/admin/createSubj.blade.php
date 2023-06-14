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

<center><br><br><h4>Add Subject</h4><br>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/subj'>Back</a></button>
<section class="section">
   <div class="col-md-6 form-table">
		<form method="POST" action="/insertSubj">
      @if(Session::has('fail'))
         <div class= "alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      @if(Session::has('success'))
         <div class= "alert alert-success">{{Session::get('success')}}</div>
      @endif
      @csrf    
		<div class="form-group" style='text-align:left'>
			<label for="year">Year <a style="color:red">*</a></label>
			<input type="text" name="subject_year" id="subject_year" class="form-control" required>
         <span class="text-danger">@error('subject_year')  {{$message}} @enderror</span>
		</div>
		<div class="form-group" style='text-align:left'>
			<label for="name">Semester <a style="color:red">*</a></label>
			<input type="text" name="subject_semester" id="subject_semester" class="form-control" required>
		</div> 
		<div class="form-group" style='text-align:left'>
			<label for="subject_code">Subject Code <a style="color:red">*</a></label>
			<input type="text" id="subject_code" name="subject_code" class="form-control" required></input>
		</div>
      <div class="form-group" style='text-align:left'>
			<label for="name">Subject Name <a style="color:red">*</a></label>
			<input type="text" name="subject_name" id="subject_name" class="form-control" required>
		</div>
      <div class="form-group" style='text-align:left'>
			<label for="name">Subject Credit Hour <a style="color:red">*</a></label>
			<input type="text" name="subject_credithr" id="subject_credithr" class="form-control" required>
         <span class="text-danger">@error('subject_credithr')  {{$message}} @enderror</span>
		</div>
      <div class="form-group" style='text-align:left'>
			<label for="name">Subject Category <a style="color:red">*</a></label>
         <select name="subject_category" type="text" class="form-control "  required>
            <option value= "" disabled selected>Select Category </option>
            <option value = "Core">Core</option>
            <option value = "Elective">Elective</option>
            <option value = "College Compulsory">College Compulsory</option>
            <option value = "MPU">MPU</option>
         </select>
		</div >
      <div class="form-group" style='text-align:left'>
		   <label for="name">Pre requisite Subject Code <a style="color:red">*</a></label>
			<input type="text" name="subject_prerequisite" id="subject_prerequisite" class="form-control" required>
		</div>
      <div class="containerIntake">
         <center><div class="form-group" >
            <label for="intake">Select Existing Intake:</label>
            <select style="width:350px; "class="form-control" name="intake" id="intake">
               <option value="">Select Intake</option>
               @foreach($intakes as $intakeId => $intake)
               <option value="{{ $intakeId }}">{{ $intake }}</option>
               @endforeach
            </select>
         </div>
         <label style="color:red" for="intake">OR</label>
         <div class="form-group" >
            <label for="new_intake">Create New Intake:</label>
            <input style = "width:350px;" type="text" class="form-control" name="new_intake" id="new_intake" placeholder="e.g., 2019/20T1"></input>
            <span style="margin-left:250px"class="text-danger">@error('new_intake')  {{$message}} @enderror</span>
         </div>
      </div>
      <button type="submit" class="btn btn-primary">Add Subject</button>
	</form>
</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>