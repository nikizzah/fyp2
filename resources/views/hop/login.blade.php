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
   <div class="col-md-4 form-table">
		<form method="POST" action="/loginhop">
         @if(Session::has('fail'))
            <div class= "alert alert-danger">{{Session::get('fail')}}</div>
         @endif
         @if(Session::has('success'))
            <div class= "alert alert-success">{{Session::get('success')}}</div>
         @endif
         @csrf
         <a style="color:black;font-size:22px; font-weight:bold">Login</a><br>
         <a style='color:#c88f73'>Head of Program</a>
			<div class="form-group" style='text-align:left'>
			   <label for="hop_id">Staff ID</label>
				<input type="text" name="hop_id" id="hop_id" class="form-control" required>
            <span class="text-danger">@error('hop_id')  {{$message}} @enderror</span>
         </div>
		   <div class="form-group" style='text-align:left'> 
				<label for="hop_password">Password</label>
				<input type="password" name="hop_password" id="hop_password" class="form-control"required>
            <span class="text-danger">@error('hop_password')  {{$message}} @enderror</span>
            <a style='color:#E4B7A0; text-decoration:underline; font-size:11px; right' href='hopforgot'>Forgot Password?</a><br>
         </div>
         <button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>