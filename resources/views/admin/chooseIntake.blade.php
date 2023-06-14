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

<section class="section">
<br><h4 style = 'margin-left: 20px;'>Course Structure</h4>

<div class="container">
	<br>
  <form method="POST" action="/intakeadmin" enctype="multipart/form-data">
      @if(Session::has('success'))
         <div class= "alert alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
         <div class= "alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      @csrf
      <div class="form-group">
      <label style="margin-left:250px;margin-top:100px" for="intake">Course Structure Intake: <a style="color:red">*</a></label>
      <select style = "width: 600px;margin-left:250px;" class="form-control" name="intake" id="intake" required>
         <option value="" disabled selected>Select Intake</option>
         @foreach($intakes as $intakeId => $intake)
               <option value="{{ $intakeId }}">{{ $intake }}</option>
         @endforeach
      </select>
      </div>
        <center><button type="submit" class="btn btn-primary">View Course Structure</button>
	</form>
</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>