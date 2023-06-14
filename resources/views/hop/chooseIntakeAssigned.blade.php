<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('css')
@include('hop.navbar')

<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Intake Advisee</h4><br>
<center><div style ="margin-top: 70px;"class="col-md-3 ">
	<form method="POST" action="/intakeAssignedhop">
   @csrf
      <div class="form-group" style='text-align:left'>
		<label for="intake">Intake: </label>
      <select name="intake" type="text" class="form-control "  required>
      <center><option value= "" disabled selected>Select Intake</option>
      @foreach ($subjects as $value) 
        <option value= "{{$value->cs_id}}">{{$value->cs_intake}} </option>
      @endforeach
      </select>
		</div>
      <button type="submit" class="btn btn-primary">Confirm</button>
	</form>
	</div>
</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>