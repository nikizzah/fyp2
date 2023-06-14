<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('advisor.navbar')

<body>

<div style="display: inline-block;">
    <button class="button">
        <a style="color:white;background-color:transparent; text-decoration:none" href="/emailone/{{$display['advisee_id']}}">Email Advisee</a>
    </button>
</div> 

<center><br><br><h4>Advisee Info</h4><br>
<section class="section">
<div class="col-md-6 form-table">
	<form method="POST" action="/editAdvisee">
        @csrf
        <div class="form-group" style='text-align:left'>
			<label for="id">Student ID</label>
			<input type="text" name="advisee_id" id="advisee_id" value = '{{$display['advisee_id']}}' class="form-control" readonly>
		</div>
		<div class="form-group" style='text-align:left'>
			<label for="name">Full Name</label>
			<input type="text" name="advisee_fname" id="advisee_fname" value = '{{$display['advisee_fname']}}' class="form-control" readonly>
		</div>
		<div class="form-group" style='text-align:left'>
			<label for="address">Address</label>
			<input type="text" id="advisee_address" name="advisee_address" value = '{{$display['advisee_address']}}' class="form-control" readonly></input>
		</div>
        <div class="form-group" style='text-align:left'>
		<label for="address">Town</label>
			<input type="text" id="advisee_town" name="advisee_town" value = '{{$display['advisee_town']}}' class="form-control" readonly></input>
		</div>
        <div class="form-group" style='text-align:left'>
			<label for="address">State</label>
			<input type="text" id="advisee_state" name="advisee_state" value = '{{$display['advisee_state']}}' class="form-control" readonly></input>
		</div>
        <div class="form-group" style='text-align:left'>
			<label for="address">Postcode</label>
			<input type="text" id="advisee_postcode" name="advisee_postcode" value = '{{$display['advisee_postcode']}}' class="form-control" readonly></input>
		</div>
        <div class="form-group" style='text-align:left'>
			<label for="contact">Contact Number</label>
			<input type="text" id="advisee_contact" name="advisee_contact" value = '{{$display['advisee_contact']}}' class="form-control" readonly></input>
		</div>
        <div class="form-group" style='text-align:left'>
			<label for="email">Email</label>
			<input type="text" id="advisee_email" name="advisee_email" value = '{{$display['advisee_email']}}' class="form-control" readonly></input>
		</div>
        <div class="form-group" style='text-align:left'>
			<label for="cgpa">CGPA</label>
			<input type="text" id="advisee_cgpa" name="advisee_cgpa" value = '{{$display['advisee_cgpa']}}' class="form-control" readonly></input>
		</div>
    </form>
</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>