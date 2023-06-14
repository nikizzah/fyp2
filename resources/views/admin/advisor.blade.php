<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

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
    text-decoration:underline ;
    font-weight:bold;
  }
</style>
@include('admin.navbar')

<body>

<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisor</h4>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/createAdvisor'>Add New Advisor</a></button>
	<div class="container">
	<br>
   <form method="POST" action="/importAdvisor" enctype="multipart/form-data">
      @if(Session::has('fail'))
         <div class= "alert alert-danger">{{Session::get('fail')}}</div>
      @elseif(Session::has('success'))
         <div class= "alert alert-success">{{Session::get('success')}}</div>
      @endif
      @csrf
      <div class="form-group" style='text-align:left'>
         <label style="margin-left:254px" for="upload_advisor">Upload Advisor: <a style="color:red">*</a></label>
         <center><input type="file" id="advisor_file" name="advisor_file" class="upload-file" required>
		</div>
         <center><button type="submit" class="btn btn-primary">Upload Advisor</button>
	</form>
      <br><br>
      <center><div class="container">
      <div style = 'margin-left: 700px;'>
      <div class="search">
         <form action="/searchAdminAdvisor" method="get">
            <input name="searchAdvisor" type="search" placeholder="Search Advisor" >
            <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
         </form>
      </div>
      </div><br>

	      <table class=table border=2>
            <tr>
				   <th>&nbsp;</th>
               <th>&nbsp;</th>
               <th>&nbsp;</th>
               <th>Staff ID</th>
               <th>Name</th>
               <th>Extension</th>
               <th>Email</th>
               <th>Position</th>
               <th>Advisee Amount</th>
            </tr>
            @foreach ($data as $display)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td><center><a style="color:#B67D67" href = {{"delAdvisor/".$display['advisor_id']}}><img  class="img-fluid" width="20px" src="{{url('source/images/delete.png')}}" alt="DELETE"></img></a></td>
               <td><center><a style="color:#B67D67" href = {{"updAdvisor/".$display['advisor_id']}}><img  class="img-fluid" width="20px" src="{{url('source/images/edit.png')}}" alt="UPDATE"></img></a></td> 
               <td>{{$display["advisor_id"]}}</td>
               <td>{{$display["advisor_name"]}}</td>
               <td>{{$display["advisor_ext"]}}</td>
               <td>{{$display["advisor_email"]}}</td>
               <td>{{$display["advisor_position"]}}</td>
               <td>{{$display["advisor_quota"]}}</td>
				</tr>
            @endforeach
         </table>
         {{ $data->links()}}
</section>

   <!-- JS Plugins -->
   <script>
function confirmDelete() {
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