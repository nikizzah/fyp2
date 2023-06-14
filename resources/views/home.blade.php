<!DOCTYPE html>

<html lang="en-us">

@include('css')
@include('homenavbar')
<body>
<center><div class="container-fluid " >
  <div class="row container-row container-top justify-content-center align-items-center">
    <div class="col-md-4 " >
      <div class="container containerHOME align-items-center justify-content-center">
      <img class="img-fluid" width="70px" src="{{url('source/images/admin.png')}}" alt="adminlogin">
      <h6>ADMIN</h6><br>
        <button class="btn-home" ><a style= 'color:black;' href='/adminlogin'>Login</a></button>
      </div>
    </div>
    <div class="col-md-4 container-column">
      <div class="container containerHOME align-items-center justify-content-center">
      <img class="img-fluid" width="70px" src="{{url('source/images/hop.png')}}" alt="hoplogin">
        <h6>HOP</h6><br>
        <button class="btn-home" ><a style= 'color:black' href='/hoplogin'>Login</a></button>
      </div>
    </div>
  </div>
  <div class="row container-row justify-content-center align-items-center">
    <div class="col-md-4 " >
      <div class="container containerHOME align-items-center justify-content-center">
      <img class="img-fluid" width="70px" src="{{url('source/images/advisor.png')}}" alt="advisorlogin">
        <h6>ADVISOR</h6><br>
        <button class="btn-home" ><a style= 'color:black' href='/advisorlogin'>Login</a></button>
      </div>
    </div>
    <div class="col-md-4 container-column">
      <div class="container containerHOME align-items-center justify-content-center">
      <img class="img-fluid" width="70px" src="{{url('source/images/advisee.png')}}" alt="adviseelogin">
        <h6>ADVISEE</h6><br>
        <button class="btn-home" ><a style= 'color:black' href='/adviseelogin'>Login</a></button>
      </div>
    </div>
  </div>
</div>


@include('script')
</body>
</html>