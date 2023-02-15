<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('css')

<body>
<!-- navigation -->
<header style = 'background-color: #A45C40;' class="sticky-top border-bottom ">
   <!-- <div class="container"> -->
   
      <nav class="navbar navbar-expand-lg ">
      
         <!-- <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
            <i class="ti-menu"></i>
         </button> -->
         -
         <div class="collapse navbar-collapse text-center" id="navigation">
         <center><br/><h1 style= 'color:black'></h1>
            <ul style='color:black' class="navbar-nav ml-auto">
<!-- /navigation -->
<!-- <a style ='align-item:right'>
<button  class="btn btn-primary">Back</button>
</a> -->

</div>
      </nav>
   </div>
</header>

<center><br><br><h4 style='font-weight: bold'>UNITEN ADVISORY AND STUDY PLANNER</h4><br>
<section class="section">
        <div class="col-md-6 form-table">
				<form method="POST" action="/registeradmin">
                    @if(Session::has('success'))
                    <div class= "alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class= "alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                <center><h4>Register</h4><br>
					<div class="form-group" style='text-align:left'>
						<label for="admin_id">Staff ID</label>
						<input type="text" name="admin_id" id="admin_id" class="form-control" required>
                        <span class="text-danger">@error('admin_id')  {{$message}} @enderror</span>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="admin_name">Full Name</label>
						<input type="text" name="admin_name" id="admin_name" class="form-control" required>
                        <span class="text-danger">@error('admin_name')  {{$message}} @enderror</span>
                    </div>
					<div class="form-group" style='text-align:left'>
						<label for="admin_paswword">Password</label>
						<input type="password" name="admin_password" id="admin_password" class="form-control" required>
                        <span class="text-danger">@error('admin_password')  {{$message}} @enderror</span>
                    </div>
					
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Register</button>
                    <br><a style='color:#E4B7A0; text-decoration:underline; font-size:11px' href='adminlogin'>Login Here</a>
				</form>
			</div>
</section>



   <!-- JS Plugins -->
   @include('script')
</body>
</html>