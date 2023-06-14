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
    font-style:italic ;
    font-weight:bold;
  }
</style>
@include('hop.navbar')

<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisor</h4>
<button class="button" ><a style="color:black" href = '/advisorlist'>Back</a></button>
<center><div class="container ">
<br><h5 style = 'margin-left: 20px;'>Advisees for <a style="color:#A45C40; font-style:normal">{{$advisor['advisor_name']}}</a></h5><br>
<table style='background-color:#F6EEE0' class=table border>
  <tr>
    <th>&nbsp;</th>
    <th>Advisee ID</th>
    <th>Advisee Name</th>
  </tr>
  @foreach ($data as $display)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td><a href = {{"infoAssigned/".$display->advisee_id}}>{{$display["advisee_id"]}}</td>
    <td><a href = {{"infoAssigned/".$display->advisee_id}}>{{$display["advisee_fname"]}}</td>
	</tr>
  @endforeach
</table>        
</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>