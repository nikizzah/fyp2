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
<!-- navigation -->

<!-- /navigation -->


<section class="section">
<br><h4 style = 'margin-left: 20px;'>Head of Program</h4>
	<!-- <button class="button" ><a style= 'color:black' href='/createHOP'>Create HOP</a></button> -->
	<div class="container">
	<br>
	<table class=table border=2>
                  <tr>
				  	<th>&nbsp;</th>
                    <!-- <th>&nbsp;</th> -->
                    <th>Staff ID</th>
                    <th>Name</th>
                  </tr>
                  @foreach ($data as $display)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{$display["advisor_id"]}}</td>
                     <td>{{$display["advisor_name"]}}</td>
				  </tr>
              @endforeach
              </table>


</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>