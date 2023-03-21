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
<button class="button" ><a style= 'color:black' href='/unassignedAdvisee'>Back</a></button>
<center><div class="container white-box">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchUnassigned" method="get" >
        <input name="searchUnassignedAdvisee" type="search" placeholder="Search Advisee">
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
        </div>
</div>
<br><h5 style = 'margin-left: 20px;'>Uassigned Advisee</h5><br>

@if(isset($unassigned))
<table style='background-color:#F6EEE0' class=table border>
    @if(count($unassigned) > 0)
    <tr>
		<th>&nbsp;</th>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Assign Advisor</th>
        <th>&nbsp;</th>
    </tr>
    <form action="/assign" method ='post'>
        @csrf
        @foreach ($unassigned as $unassign)
        <tr>
            <td> {{ $loop->iteration }}</td>
            <td><input style="border:none; background-color: transparent;" type="text" name='advisee_id' id="advisee_id" value="{{$unassign["advisee_id"]}}" readonly></td>
            <td><input style="border:none; background-color: transparent;" type="text" name="advisee_fname" value="{{$unassign["advisee_fname"]}}" readonly></td>
            <td>
                <select style="color:#E4B7A0; border:#E4B7A0" name="assign" type="text" class="form-control ">
                <option value="">Select Advisor</option>  
                @foreach ($advisor as $assign) 
                    <option value= "{{$assign->advisor_name}}">{{$assign->advisor_name}}</option>
                @endforeach   
                </select>
            </td>
            <td><button type="submit" class="btn btn-primary">Assign Advisor</button>
		</tr>
        @endforeach
        @else
            <tr><td style="font-size: 15px">No result found!</td></tr>
        @endif
              
</table>
@endif
</table>
</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>