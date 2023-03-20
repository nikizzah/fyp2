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

<center><br><br><h4>Create Advisor</h4><br>
<button class="button" ><a style= 'color:black' href='/advisor'>Back</a></button>
<section class="section">
        <div class="col-md-6 form-table">
				<form method="POST" action="/insertAdvisor">
            @csrf
					<div class="form-group" style='text-align:left'>
						<label for="id">Staff ID</label>
						<input type="text" name="advisor_id" id="advisor_id" class="form-control">
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="name">Full Name</label>
						<input type="text" name="advisor_name" id="advisor_name" class="form-control">
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="extension">Extension</label>
						<input type="text" name="advisor_ext" id="advisor_ext" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="email">Email</label>
						<input type="text" name="advisor_email" id="advisor_email" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="position">Position</label>
						<input type="text" name="advisor_position" id="advisor_position" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="quota">Quota</label>
						<input type="text" name="advisor_quota" id="advisor_quota" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="status">Status</label>
						<!-- <input type="text" name="advisor_status" id="advisor_status" class="form-control"></input> -->
                  <br><center><input class="active-button" type="radio" value="Active" id="advisor_status" name="advisor_status" checked>
                  <label style="color:green" for="active">Active</label>
                  <input class="inactive-button" type="radio" value="Inactive" id="advisor_status" name="advisor_status">
                  <label style="color:red" for="inactive">Inactive</label>
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Create Advisor</button>
				</form>
			</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>