<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('css')
<head>
<style>
  ::placeholder {
    color: black;
  }
  input {
    color:black;
  }
  input:hover {
    color: #A45C40;
    font-style:italic ;
    font-weight:bold;
  }
  a:hover {
    color: #A45C40;
    font-weight:bold;
  }
</style>
</head>
@include('hop.navbar')

<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisee</h4>
<button class="button" ><a style= 'color:white;background-color:transparent; text-decoration:none' href='/unassignedAdvisee'>Back</a></button>
<center><div class="container ">
<div style = 'margin-left: 700px;'>
    <form action="/searchUnassigned" method="get" >
        <input style="border:none; background-color: transparent;" type="hidden" name="intake" value="{{$intake}}" readonly onfocus="this.style.border = 'none'; this.style.outline = 'none';">
        <div class="search">
        <input style= 'background-color:transparent; text-decoration:none; font-style:normal; font-weight:normal' name="searchUnassignedAdvisee" type="search" placeholder="Search Advisee" required>
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
        </div>
      </form>
</div>
<br><h5 style = 'margin-left: 20px;'>Uassigned Advisee -  <a style ="color:#A45C40;  font-style:normal">Intake {{$intake}}</a> </h5><br>

  @if(isset($unassigned))
    <table style='background-color:#F6EEE0' class=table border>
        @if(count($unassigned) > 0)
        <tr>
        <th>&nbsp;</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Assign Advisor</th>
        </tr>
        <form action="/assign" method ='post'>
            @csrf
            @foreach ($unassigned as $unassign)
            <tr>
                <td> {{ $loop->iteration }}</td>
                <td><a style="color:black" href = {{"infoUnassigned/".$unassign['advisee_id']}}><input style="border:none; background-color: transparent;" type="text" name='advisee_id[]' id="advisee_id" value="{{$unassign["advisee_id"]}}" readonly onfocus="this.style.border = 'none'; this.style.outline = 'none';"></td>
                <td><a style="color:black; border-color:transparent" href = {{"infoUnassigned/".$unassign['advisee_id']}}><input style="border:none; background-color: transparent;" type="text" name="advisee_fname[]" value="{{$unassign["advisee_fname"]}}" readonly onfocus="this.style.border = 'none'; this.style.outline = 'none';"></td>
                <td>
                    <select style="color:#E4B7A0; border:#E4B7A0" name="assign" type="text" class="form-control ">
                    <option value="" disabled="true" selected= "true">Select Advisor</option>  
                    @foreach ($advisor as $assign) 
                        <option value= "{{$assign->advisor_name}}">{{$assign->advisor_name}}</option>
                    @endforeach   
                    </select>
                </td>
            </tr>
            @endforeach
    </table>
    <button type="submit" class="btn btn-primary" onclick="confirmAssign()">Assign Advisor</button>
    @else
      <tr><td style="font-size: 15px">No result found!</td></tr>
    @endif           
  @endif
</table>
</section>
  <script>
    function confirmAssign() {
      var result = confirm("Are you sure you want to assign?");
      if (result) {
          var url = '/assign';
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
              alert('An error occurred while processing the request. Please check the console for more information.'); 
              }

          });
      } else {
          return false;
      }
  }
  </script>
  <!-- JS Plugins -->
  @include('script')
</body>
</html>