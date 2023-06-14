<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('advisor.navbar')

<body>

<form method="POST" action="/sendall">
    @csrf
<center><br><br><br><br><h4>Email Advisees </h4><br>
<section class="section">
    <div class="col-md-6 form-table">
            <div class="form-group" style='text-align:left'>
				<label for="email">Advisees Emails <a style="color:red">*</a></label>
                <input type="text" name="advisee_email" id="advisee_email" class="form-control" value="{{ implode(', ', array_column($data->toArray(), 'advisee_email')) }}" required></input>
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
        var url = '/sendall';
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
				alert('All fields are required'); 
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