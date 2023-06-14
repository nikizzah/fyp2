<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('css')
@include('advisee.navbar')

<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Planning</h4><br>
<div style="display: flex; align-items: center;margin-left: 50px;">
   <a style="color:black; font-size:17px;">Student Name: </a> <a style="color: #A45C40; font-size:17px">&nbsp;{{$display['advisee_fname']}} </a>&nbsp;&nbsp;&nbsp;&nbsp;
   <a style="color:black; font-size:17px;">Student ID: </a><a style="color: #A45C40">&nbsp;{{$display['advisee_id']}} </a> &nbsp;&nbsp;&nbsp;&nbsp; 
</div>
<center><div style ="margin-top: 70px;"class="col-md-3 ">
	<form method="POST" action="/planning">
   @csrf
      <div class="form-group" style='text-align:left'>
		   <label for="name">Year: </label>
         <select name="year" type="text" class="form-control "  required>
            <center><option value= " ">Select Year</option>
            @foreach ($subjects as $value) 
            <option value= "{{$value->subject_year}}">{{$value->subject_year}}</option>
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