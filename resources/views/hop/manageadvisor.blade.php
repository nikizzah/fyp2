<!DOCTYPE html>

<html lang="en-us">

@include('css')
<style>
  ::placeholder {
    color: black;
  }
  a {
    color:black;
  }
  a:hover {
    color: #A45C40;
    text-decoration:underline;
    font-weight:bold;
  }
</style>
@include('hop.navbar')

<body>
  <form method="POST" action="/change">
    @csrf
    @foreach($data as $display)
    <div style="display: flex; align-items: center;margin-left: 50px; margin-top:40px">
        <a style="color:black; font-size:17px;">Student Name: </a>
        <input name='advisee_fname' value="{{$display['advisee_fname']}}" style="font-size:17px; border:none; background-color:transparent; color:#A45C40;" readonly >
        </input>&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="color:black; font-size:17px;">Student ID: </a>
        <input name='advisee_id' value="{{$display['advisee_id']}}" style="font-size:17px; border:none; background-color:transparent; color:#A45C40;" readonly >
        </input>&nbsp;
    </div>
    <center><br><br><h4>Change Advisor</h4><br>
    <button class="button" ><a style="color:white;background-color:transparent; text-decoration:none" href = '/assignedAdvisee'>Back</a></button>
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
      <button type="button" class="btn btn-primary" onclick="confirmChange()">Change Advisor</button>
    @endforeach
  </form>
  </div>
</section>
<script>
function confirmChange() {
    var result = confirm("Are you sure you want to change advisor?");
    if (result) {
        var url = '/change';
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
   @include('script')
</body>
</html>