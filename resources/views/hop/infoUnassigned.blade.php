<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('hop.navbar')

<body>

<center><br><br><h4>Advisee Info</h4><br>
<section class="section">
	<div class="col-md-6 form-table">
		<form method="POST" action="/assignone">
            @if(Session::has('error'))
                <div class= "alert alert-danger">{{Session::get('error')}}</div>
            @endif
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
            <div class="form-group" style='text-align:left'>
				<label for="advisor">Advisor</label>
				<select style="color:black; border:#E4B7A0" name="advisor_id" type="text" class="form-control ">
                    <option value="" disabled="true" selected= "true">Select Advisor</option>  
                    @foreach ($advisor as $assign) 
                    <option value= "{{$assign['advisor_id']}}">{{$assign['advisor_name']}}</option>
                    @endforeach   
            	</select>
			</div>
            <button type="button" class="btn btn-primary" onclick="confirmAssign()">Assign Advisor</button>
		</form>
	</div>
</section>
<script>
function confirmAssign() {
    var result = confirm("Are you sure you want to assign?");
    if (result) {
        var url = '/assignone';
        var data = $('form').serialize();
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
				if (response.success) {
					alert(response.success); 
					window.location.href = '/assignedAdvisee'; 
				} else if (response.error) {
					alert(response.error); 
				}
			},
            error: function(xhr, status, error) {
				console.log(xhr.responseText); 
				alert('An error occurred while processing the request. '); 
			}
		});
    } else {
        return false;
    }
}
</script>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>