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
<center><br><br><h4>Add Advisee</h4><br>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/advisee'>Back</a></button>
<section class="section">
   <div class="col-md-6 form-table">
		<form method="POST" action="/insertAdvisee" >
         @if(Session::has('fail'))
            <div class= "alert alert-danger">{{Session::get('fail')}}</div>
         @endif
			@if(Session::has('success'))
            <div class= "alert alert-success">{{Session::get('success')}}</div>
         @endif
         @csrf
               
			<div class="form-group" style='text-align:left'>
			   <label for="id">Student ID <a style="color:red">*</a></label>
				<input type="text" name="advisee_id" id="advisee_id" class="form-control" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="name">Full Name <a style="color:red">*</a></label>
				<input type="text" name="advisee_fname" id="advisee_fname" class="form-control" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="address">Address <a style="color:red">*</a></label>
				<textarea id="advisee_address" name="advisee_address" class="form-control"  rows='4' required></textarea>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="address">Town <a style="color:red">*</a></label>
				<input type="text" id="advisee_town" name="advisee_town" class="form-control" required></input>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="address">State <a style="color:red">*</a></label>
				<input type="text" id="advisee_state" name="advisee_state" class="form-control" required></input>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="address">Postcode <a style="color:red">*</a></label>
				<input type="text" id="advisee_postcode" name="advisee_postcode" class="form-control" required></input>
				<span class="text-danger">@error('advisee_postcode')  {{$message}} @enderror</span>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="contact">Contact Number <a style="color:red">*</a></label>
				<input type="text" id="advisee_contact" name="advisee_contact" class="form-control" required></input>
				<span class="text-danger">@error('advisee_contact')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="email">Email <a style="color:red">*</a></label>
				<input type="text" id="advisee_email" name="advisee_email" class="form-control" required></input>
				<span class="text-danger">@error('advisee_email')  {{$message}} @enderror</span>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="cgpa">CGPA <a style="color:red">*</a></label>
				<input type="text" id="advisee_cgpa" name="advisee_cgpa" class="form-control" required></input>
            <span class="text-danger">@error('advisee_cgpa')  {{$message}} @enderror</span>
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
	   <br>
         <button type="submit" class="btn btn-primary">Add Advisee</button>
	   </form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>