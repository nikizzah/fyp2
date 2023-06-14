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
<br><h4 style = 'margin-left: 20px;'>Advisor</h4>
<button class="button" ><a style= 'color:black' href='/advisor'>Back</a></button>
<center><div class="container">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchAdminAdvisor" method="get">
        <input name="searchAdvisor" type="search" placeholder="Search Advisor" >
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
        </div>
</div>
<br>
@if(isset($data))
<table style='background-color:#F6EEE0' class=table border>

    @if(count($data) > 0)
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
@else
    <tr><td style="font-size: 15px">No result found!</td></tr>
@endif
              
</table>
@endif

</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>