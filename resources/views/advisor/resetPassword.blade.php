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
<header style = 'background-color: #A45C40;' class="sticky-top border-bottom ">
      <nav class="navbar navbar-expand-lg ">
   
         <div class="collapse navbar-collapse text-center" id="navigation">
         <center><br/><a style= 'color:black; margin-top: 10px; '></a>
         <center><br/><h4 style= 'color:black; margin-left:500px;'>UNITEN ADVISORY AND STUDY PLANNER</h4>
         <center><br/><a style= 'color:black; margin-top: 37px; '></a>
            <center><ul style='color:black' class="navbar-nav ">
               <li class="nav-item" ><a href="https://www.uniten.edu.my/">
               <img style='position: absolute; top: 15px; right: 16px' class="img-fluid" width="120px" src="{{url('source/images/logo-uniten.png')}}" alt="UNITEN">
               </a>
            </ul>

         </div>
      </nav>
   </div>
</header>

<br><br>
<center>
<section class="section">
   <div class="col-md-6 form-table">
		<form method="POST" action="/resetadvisor">
         @if(Session::has('fail'))
            <div class= "alert alert-danger">{{Session::get('fail')}}</div>
         @endif
         @csrf
         <a style="color:black;font-size:22px; font-weight:bold">Reset Password</a><br>
         <a style='color:#c88f73'>Advisor</a>
			<div class="form-group" style='text-align:left'>
				<label for="advisor_id">Staff ID</label>
				<input type="text" name="advisor_id" id="advisor_id" class="form-control" required>
            <span class="text-danger">@error('advisor_id')  {{$message}} @enderror</span>
         </div>
			<div class="form-group" style='text-align:left'>
				<label for="advisor_password">Current Password</label>
				<input type="password" name="advisor_password" id="advisor_password" class="form-control" required>
            <span class="text-danger">@error('advisor_password')  {{$message}} @enderror</span>
         </div>
         <div class="form-group" style='text-align:left'>
				<label for="newpass">New Password</label>
				<input type="password" name="newpass" id="newpass" class="form-control" placeholder="5 to 10 characters" required>
            <span class="text-danger">@error('newpass')  {{$message}} @enderror</span>
         </div>
         <button type="submit" class="btn btn-primary">Reset Password</button>
         <br><a style='color:#E4B7A0; text-decoration:underline; font-size:11px' href='advisorlogin'>Login</a>
		</form>
	</div>
</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>