<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('advisee.navbar')

<body>


<center><br><br><h4>Advisee Info</h4><br>

<section class="section">
	<div class="col-md-6 form-table">
		<form method="POST" action="/AdviseeEdit">
        	@csrf
			@if(Session::has('fail'))
            	<div class= "alert alert-danger">{{Session::get('fail')}}</div>
			@endif
            @if(Session::has('success'))
                <div class= "alert alert-success">{{Session::get('success')}}</div>
            @endif
			<div class="form-group" style='text-align:left'>
				<label for="id">Student ID</label>
				<input type="text" name="advisee_id" id="advisee_id" value = '{{$display['advisee_id']}}' class="form-control" readonly>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="name">Full Name</label>
				<input type="text" name="advisee_fname" id="advisee_fname" value = '{{$display['advisee_fname']}}' class="form-control" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="address">Address</label>
				<input type="text" id="advisee_address" name="advisee_address" value = '{{$display['advisee_address']}}' class="form-control" required></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="address">Town</label>
				<input type="text" id="advisee_town" name="advisee_town" value = '{{$display['advisee_town']}}' class="form-control" required></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="address">State</label>
				<input type="text" id="advisee_state" name="advisee_state" value = '{{$display['advisee_state']}}' class="form-control" required></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="address">Postcode</label>
				<input type="text" id="advisee_postcode" name="advisee_postcode" value = '{{$display['advisee_postcode']}}' class="form-control" required></input>
				<span class="text-danger">@error('advisee_postcode')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="contact">Contact Number</label>
				<input type="text" id="advisee_contact" name="advisee_contact" value = '{{$display['advisee_contact']}}' class="form-control" required></input>
				<span class="text-danger">@error('advisee_contact')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'> 
				<label for="email">Email</label>
				<input type="text" id="advisee_email" name="advisee_email" value = '{{$display['advisee_email']}}' class="form-control" required></input>
				<span class="text-danger">@error('advisee_email')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="cgpa">CGPA</label>
				<input type="text" id="advisee_cgpa" name="advisee_cgpa" value = '{{$display['advisee_cgpa']}}' class="form-control" readonly></input>
				<span class="text-danger">@error('advisee_cgpa')  {{$message}} @enderror</span>
			</div>
            <button type="submit" class="btn btn-primary">Update</button> 
		</form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>