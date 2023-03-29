<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('hop.navbar')

<body>
<form method="POST" action="/change">
@csrf
@foreach($data as $display)
<div style="display: flex; align-items: center;">
  <label for="adviseename">Student Name:</label>
  <input style="border:none; background-color: transparent;" type="text" id="advisee_fname" name="advisee_fname" value="{{$display['advisee_fname']}}" class="form-control" readonly onfocus="this.style.border = 'none'; this.style.outline = 'none';">
  <label for="adviseeid">Student ID:</label>
  <input style="border:none; background-color: transparent;" type="text" id="advisee_id" name="advisee_id" value="{{$display['advisee_id']}}" class="form-control" readonly onfocus="this.style.border = 'none'; this.style.outline = 'none';">
</div>
<center><br><br><h4>Change Advisor</h4><br>
<button class="button" ><a style="color:black" href = '/assignedAdvisee'>Back</a></button>
<section class="section">
<div class="col-md-6 form-table">
@if(Session::has('error'))
    <div class= "alert alert-danger">{{Session::get('error')}}</div>
@elseif(Session::has('success'))
    <div class= "alert alert-success">{{Session::get('success')}}</div>
@endif
                    <div class="form-group" style='text-align:left'>
						<label for="advisor">Current Advisor</label>
						<input type="text" id="advisor_name" name="current_advisor_name" value = '{{$display['advisor_name']}}' class="form-control" readonly></input>
					</div>
                    <div class="form-group" style='text-align:left'>
                    <label for="new advisor">New Advisor: </label>
                    <select style="color:black; border:#E4B7A0" name="advisor_id" type="text" class="form-control ">
                           <option value="" disabled="true" selected= "true">Select Advisor</option>  
                           @foreach ($advisor as $assign) 
                           <option value= "{{$assign['advisor_id']}}">{{$assign['advisor_name']}}</option>
                           @endforeach   
                        </select>
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Confirm</button>
				@endforeach
                </form>
			</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>