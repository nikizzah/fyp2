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
<br><h4 style = 'margin-left: 20px;'>Advisor</h4>
<center><div class="container white-box">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="get" >
    <i class="ti-search" aria-hidden ="true"></i>
        <input name="searchAdvisor" type="search" placeholder="Search Advisor" >
    </form>
<!-- <button id="searchClose" class="search-close"><i class="ti-close text-dark"></i></button> -->
        </div>
</div>
<br><h5 style = 'margin-left: 20px;'>Advisors</h5><br>
               
<table style='background-color:#F6EEE0' class=table border>
                  <tr>
                  <th>&nbsp;</th>
                    <th>Advisor Quota</th>
                    <th>Advisor Name</th>
                  </tr>
                  @foreach ($data as $display)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{$display["advisor_quota"]}}</td>
                     <td>{{$display["advisor_name"]}}</td>
				  </tr>
              @endforeach
              </table>

</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>