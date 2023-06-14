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
<center><br><br><h4>Update Advisee</h4><br>
<button class="button" ><a style= 'color:black' href='/advisee'>Back</a></button>
<section class="section">
    <div class="col-md-6 form-table">
		<form method="POST" action="/editAdvisee">
            @if(Session::has('fail'))
                <div class= "alert alert-danger">{{Session::get('fail')}}</div>
            @elseif(Session::has('success'))
                <div class= "alert alert-danger">{{Session::get('success')}}</div>
            @endif
            @csrf
			<div class="form-group" style='text-align:left'>
				<label for="id">Student ID </label>
				<input type="text" name="advisee_id" id="advisee_id" value = '{{$display['advisee_id']}}' class="form-control" required readonly>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="name">Full Name <a style="color:red">*</a></label>
				<input type="text" name="advisee_fname" id="advisee_fname" value = '{{$display['advisee_fname']}}' class="form-control" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="address">Address <a style="color:red">*</a></label>
				<input type="text" id="advisee_address" name="advisee_address" value = '{{$display['advisee_address']}}' class="form-control"></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="address">Town <a style="color:red">*</a></label>
				<input type="text" id="advisee_town" name="advisee_town" value = '{{$display['advisee_town']}}' class="form-control"></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="address">State <a style="color:red">*</a></label>
				<input type="text" id="advisee_state" name="advisee_state" value = '{{$display['advisee_state']}}' class="form-control"></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="address">Postcode <a style="color:red">*</a></label>
				<input type="text" id="advisee_postcode" name="advisee_postcode" value = '{{$display['advisee_postcode']}}' class="form-control"></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="contact">Contact Number <a style="color:red">*</a></label>
				<input type="text" id="advisee_contact" name="advisee_contact" value = '{{$display['advisee_contact']}}' class="form-control"></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="email">Email <a style="color:red">*</a></label>
				<input type="text" id="advisee_email" name="advisee_email" value = '{{$display['advisee_email']}}' class="form-control"></input>
            	<span class="text-danger">@error('advisee_email')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="cgpa">CGPA </label>
				<input type="text" id="advisee_cgpa" name="advisee_cgpa" value = '{{$display['advisee_cgpa']}}' class="form-control"></input>
            	<span class="text-danger">@error('advisee_cgpa')  {{$message}} @enderror</span>
			</div>
                <button type="submit" class="btn btn-primary">Update Advisee</button>
		</form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>