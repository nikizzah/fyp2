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
				<form method="POST" action="/loginhop">
             @if(Session::has('fail'))
                    <div class= "alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
               @csrf
                <center><h4>Login</h4><br>
					<div class="form-group" style='text-align:left'>
						<label for="hop_id">Staff ID</label>
						<input type="text" name="hop_id" id="hop_id" class="form-control" required>
                  <span class="text-danger">@error('hop_id')  {{$message}} @enderror</span>
               </div>
					<div class="form-group" style='text-align:left'>
						<label for="hop_password">Password</label>
						<input type="password" name="hop_password" id="hop_password" class="form-control" required>
                  <span class="text-danger">@error('hop_password')  {{$message}} @enderror</span>
               </div>
					
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Login</button>
                    <br><a style='color:#E4B7A0; text-decoration:underline; font-size:11px' href='hopregister'>Register Here</a>
				</form>
			</div>
</section>



   <!-- JS Plugins -->
   @include('script')
</body>
</html>