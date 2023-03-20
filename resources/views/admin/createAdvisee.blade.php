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
<!-- <a style ='align-item:right'>
<button  class="btn btn-primary">Back</button>
</a> -->

<center><br><br><h4>Create Advisee</h4><br>
<button class="button" ><a style= 'color:black' href='/advisee'>Back</a></button>
<section class="section">
        <div class="col-md-6 form-table">
				<form method="POST" action="/importAdvisee" enctype="multipart/form-data">
            @if(Session::has('fail'))
                    <div class= "alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
               @csrf
               
					<!-- <div class="form-group" style='text-align:left'>
						<label for="id">Student ID</label>
						<input type="text" name="advisee_id" id="advisee_id" class="form-control" required>
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="name">Full Name</label>
						<input type="text" name="advisee_fname" id="advisee_fname" class="form-control" required>
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="address">Address</label>
						<textarea id="advisee_address" name="advisee_address" class="form-control"  rows='4' required></textarea>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="address">Town</label>
						<input type="text" id="advisee_town" name="advisee_town" class="form-control" required></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="address">State</label>
						<input type="text" id="advisee_state" name="advisee_state" class="form-control" required></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="address">Postcode</label>
						<input type="text" id="advisee_postcode" name="advisee_postcode" class="form-control" required></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="contact">Contact Number</label>
						<input type="text" id="advisee_contact" name="advisee_contact" class="form-control" required></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="email">Email</label>
						<input type="text" id="advisee_email" name="advisee_email" class="form-control" required></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="cgpa">CGPA</label>
						<input type="text" id="advisee_cgpa" name="advisee_cgpa" class="form-control" required></input>
                  <span class="text-danger">@error('advisee_cgpa')  {{$message}} @enderror</span>
					</div>
                  <div class="form-group" style='text-align:left'>
						<label for="status">Status</label>
						
                  <br><center><input class="active-button" type="radio" value="Active" id="advisee_status" name="advisee_status" checked>
                  <label style="color:green" for="active">Active</label>
                  <input class="graduate-button" type="radio" value="graduated" id="advisee_status" name="advisee_status">
                  <label style="color:orange" for="graduated">Graduated</label>
                  <input class="dropout-button" type="radio" value="dropout" id="advisee_status" name="advisee_status">
                  <label style="color:red" for="dropout">Drop Out</label>
					</div> -->
               
               <div class="form-group" style='text-align:left'>
						<label for="advisee_file">Choose File</label>
                  <input type="file" id="advisee_file" name="advisee_file" class="form-control" required></input>
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Create Advisee</button>
				</form>
			</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>