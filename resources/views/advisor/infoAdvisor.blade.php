<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('advisor.navbar')

<body>

<center><br><br><h4>Advisor Info</h4><br>
<section class="section">
    <div class="col-md-6 form-table">
		<form method="POST" action="/AdvisorEdit">
            @csrf
			@if(Session::has('fail'))
            	<div class= "alert alert-danger">{{Session::get('fail')}}</div>
			@endif
            @if(Session::has('success'))
                <div class= "alert alert-success">{{Session::get('success')}}</div>
            @endif
			<div class="form-group" style='text-align:left'>
				<label for="id">Staff ID</label>
				<input type="text" name="advisor_id" id="advisor_id" class="form-control" value = '{{$display['advisor_id']}}' readonly></input>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="name">Full Name</label>
				<input type="text" name="advisor_name" id="advisor_name" class="form-control" value = '{{$display['advisor_name']}}' required></input>
			</div>
			<div class="form-group" style='text-align:left'>
				<label for="extension">Extension</label>
				<input type="text" name="advisor_ext" id="advisor_ext" class="form-control" value = '{{$display['advisor_ext']}}' required></input>
				<span class="text-danger">@error('advisor_ext')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="email">Email</label>
				<input type="text" name="advisor_email" id="advisor_email" class="form-control" value = '{{$display['advisor_email']}}' required></input>
				<span class="text-danger">@error('advisor_email')  {{$message}} @enderror</span>
			</div>
            <div class="form-group" style='text-align:left'>
				<label for="quota">Advisee Amount</label>
				<input type="text" name="advisor_quota" id="advisor_quota" class="form-control" value = '{{$display['advisor_quota']}}' readonly></input>
			</div>
            <button type="submit" class="btn btn-primary">Update</button> 
		</form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>