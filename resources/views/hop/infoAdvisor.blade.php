<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('hop.navbar')

<body>

<center><br><br><h4>Advisor Info</h4><br>
<section class="section">
    <div class="col-md-6 form-table">
		<form method="POST" action="/insertAdvisor">
            @csrf
			<div class="form-group" style='text-align:left'>
				<label for="id">Staff ID</label>
				<input type="text" name="advisor_id" id="advisor_id" class="form-control" value = '{{$display['advisor_id']}}' readonly></input>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="name">Full Name</label>
				<input type="text" name="advisor_name" id="advisor_name" class="form-control" value = '{{$display['advisor_name']}}' readonly></input>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="extension">Extension</label>
				<input type="text" name="advisor_ext" id="advisor_ext" class="form-control" value = '{{$display['advisor_ext']}}' readonly></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="email">Email</label>
				<input type="text" name="advisor_email" id="advisor_email" class="form-control" value = '{{$display['advisor_email']}}' readonly></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="position">Position</label>
				<input type="text" name="advisor_position" id="advisor_position" class="form-control" value = '{{$display['advisor_position']}}' readonly></input>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="quota">Quota</label>
				<input type="text" name="advisor_quota" id="advisor_quota" class="form-control" value = '{{$display['advisor_quota']}}' readonly></input>
			</div>
		</form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>