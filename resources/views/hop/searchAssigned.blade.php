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
<br><h4 style = 'margin-left: 20px;'>Advisee</h4>
<button class="button" ><a style= 'color:black' href='/chooseadvisee'>Back</a></button>
<center><div class="container white-box">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchAssignedAdvisee" method="get">
        <input name="searchAssignedAdvisee" type="search" placeholder="Search Advisee" >
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
<!-- <button id="searchClose" class="search-close"><i class="ti-close text-dark"></i></button> -->
        </div>
</div>
<br><h5 style = 'margin-left: 20px;'>Assigned Advisee</h5><br>

@if(isset($assigned))
<table style='background-color:#F6EEE0' class=table border>

@if(count($assigned) > 0)
                  <tr>
				  	     <th>&nbsp;</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Assigned Advisor</th>
                  </tr>
                  @foreach ($assigned as $assign)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$assign["advisee_id"]}}</td>
                    <td>{{$assign["advisee_fname"]}}</td>
                    <td>{{$assign["advisor_name"]}}</td>
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