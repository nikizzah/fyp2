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
<table style='background-color:#F6EEE0' class=table border>
                  <tr>
				  	     <th>&nbsp;</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Assigned Advisor</th>
                  </tr>
                  @foreach ($data as $display)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$display->advisee_id}}</td>
                    <td>{{$display->advisee_fname}}</td>
                    <td>{{$display->advisor_name}}</td>
				  </tr>
              
              @endforeach
              </table>

</section>


<!-- <footer class="section-sm pb-0 border-top border-default">
      <div class="container">
         <div class="row justify-content-between">
             <div class="col-md-3 mb-4">
               <a class="mb-4 d-block" href="index.html">
                  <img class="img-fluid" width="150px" src="images/logo.png" alt="LogBook">
               </a>
               <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            </div> 


            <div class="col-lg-2 col-md-3 col-6 mb-4">
               <h6 class="mb-4">Quick Links</h6>
               <ul class="list-unstyled footer-list">
                  <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li><a href="terms-conditions.html">Terms Conditions</a></li>
               </ul>
            </div>

            <div class="col-lg-2 col-md-3 col-6 mb-4">
               <h6 class="mb-4">Social Links</h6>
               <ul class="list-unstyled footer-list">
                  <li><a href="#">facebook</a></li>
                  <li><a href="#">twitter</a></li>
                  <li><a href="#">linkedin</a></li>
                  <li><a href="#">github</a></li>
               </ul>
            </div>

            <div class="col-md-3 mb-4">
               <h6 class="mb-4">Subscribe Newsletter</h6>
               <form class="subscription" action="javascript:void(0)" method="post">
                  <div class="position-relative">
                     <i class="ti-email email-icon"></i>
                     <input type="email" class="form-control" placeholder="Your Email Address">
                  </div>
                  <button class="btn btn-primary btn-block rounded" type="submit">Subscribe now</button>
               </form>
            </div>
         </div>
         <div class="scroll-top">
            <a href="javascript:void(0);" id="scrollTop"><i class="ti-angle-up"></i></a>
         </div>
         <div class="text-center">
            <p class="content">&copy; 2020 - Design &amp; Develop By <a href="https://themefisher.com/" target="_blank">Themefisher</a></p>
         </div>
      </div>
   </footer> -->


   <!-- JS Plugins -->
   @include('script')
</body>
</html>