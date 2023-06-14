<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('advisor.navbar')

<body>

<form method="POST" action="/sendone">
    @csrf
<center><br><br><br><br><br><a style="color:black; font-size:25px; margin-left:170px; font-weight:bold; font-style:normal">Email to </a>
    <input name='advisee_fname' value="{{$data['advisee_fname']}}" style="font-weight:bold;font-size:25px; border:none; background-color:transparent; color:#A45C40;" readonly >
    </input>&nbsp;&nbsp;&nbsp;&nbsp;
<section class="section">
    <div class="col-md-6 form-table">
		
            <div class="form-group" style='text-align:left'>
				<label for="email">Advisee Email <a style="color:red">*</a></label>
                <input type="text" name="advisee_email" id="advisee_email" class="form-control" value="{{ $data['advisee_email'] }}" required>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="subject">Subject</label>
				<input type="text" name="subject" id="subject" class="form-control" required></input>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="description">Description</label>
				<textarea type="text" name="description" id="description" class="form-control" required></textarea>
			</div>
            <button type="button" class="btn btn-primary" onclick="confirmSend()">Send Email</button> 
		</form>
	</div>
</section>

<script>
function confirmSend() {
    var result = confirm("Are you sure you want to send email?");
    if (result) {
        var url = '/sendone';
        var data = $('form').serialize();
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
				if (response.success) {
					alert(response.success); 
					window.location.href = '/listadvisee'; 
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