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
	<form method="POST" action="/loginadmin">
      @if(Session::has('fail'))
         <div class= "alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      @csrf
      <a style="color:black;font-size:22px; font-weight:bold">Login</a><br>
      <a style='color:#c88f73'>Admin</a>
		<div class="form-group" style='text-align:left'>
			<label for="id">Staff ID</label>
			<input type="text" name="admin_id" id="admin_id" class="form-control" required>
         <span class="text-danger">@error('admin_id')  {{$message}} @enderror</span>
      </div>
		<div class="form-group" style='text-align:left'>
			<label for="paswword">Password</label>
			<input type="password" name="admin_password" id="admin_password" class="form-control" required>
         <span class="text-danger">@error('admin_password')  {{$message}} @enderror</span>
      </div>
					
         <button type="submit" class="btn btn-primary">Login</button>
	</form>
   </div>
</section>



   <!-- JS Plugins -->
   @include('script')
</body>
</html>