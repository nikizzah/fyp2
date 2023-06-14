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

<center><br><br><h4>Add Advisor</h4><br>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/advisor'>Back</a></button>
<section class="section">
    <div class="col-md-6 form-table">
		<form method="POST" action="/insertAdvisor">
			@if(Session::has('fail'))
            	<div class= "alert alert-danger">{{Session::get('fail')}}</div>
            @endif
			@if(Session::has('success'))
                <div class= "alert alert-success">{{Session::get('success')}}</div>
            @endif
            @csrf
			<div class="form-group" style='text-align:left'>
				<label for="id">Staff ID <a style="color:red">*</a></label>
				<input type="text" name="advisor_id" id="advisor_id" class="form-control" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="name">Full Name <a style="color:red">*</a></label>
				<input type="text" name="advisor_name" id="advisor_name" class="form-control" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="extension">Extension <a style="color:red">*</a></label>
				<input type="text" name="advisor_ext" id="advisor_ext" class="form-control" required></input>
				<span class="text-danger">@error('advisor_ext')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="email">Email <a style="color:red">*</a></label>
				<input type="text" name="advisor_email" id="advisor_email" class="form-control" required></input>
				<span class="text-danger">@error('advisor_email')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="position">Position <a style="color:red">*</a></label>
				<input type="text" name="advisor_position" id="advisor_position" class="form-control" required></input>
			</div>
                <button type="submit" class="btn btn-primary">Add Advisor</button>
		</form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>