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
    <form action="/searchAdvisor" method="get">
        <input name="searchAdvisor" type="search" placeholder="Search Advisor" >
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
        </div>
</div>
<br><h5 style = 'margin-left: 20px;'>Advisors</h5><br>
               
@if(isset($advisor))
<table style='background-color:#F6EEE0' class=table border>

@if(count($advisor) > 0)
                  <tr>
                  <th>&nbsp;</th>
                    <th>Advisor Quota</th>
                    <th>Advisor Name</th>
                  </tr>
                  @foreach ($advisor as $display)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{$display["advisor_quota"]}}</td>
                     <td>{{$display["advisor_name"]}}</td>
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