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
<!-- <a style ='align-item:right'>
<button  class="btn btn-primary">Back</button>
</a> -->

<center><br><br><h4>Update Advisee</h4><br>
<button class="button" ><a style= 'color:black' href='/advisee'>Back</a></button>
<section class="section">
        <div class="col-md-6 form-table">
				<form method="POST" action="/editAdvisee">
               @csrf
					<div class="form-group" style='text-align:left'>
						<label for="id">Student ID</label>
						<input type="text" name="advisee_id" id="advisee_id" value = '{{$display['advisee_id']}}' class="form-control" required>
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="name">Full Name</label>
						<input type="text" name="advisee_fname" id="advisee_fname" value = '{{$display['advisee_fname']}}' class="form-control" required>
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="address">Address</label>
						<input type="text" id="advisee_address" name="advisee_address" value = '{{$display['advisee_address']}}' class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="address">Town</label>
						<input type="text" id="advisee_town" name="advisee_town" value = '{{$display['advisee_town']}}' class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="address">State</label>
						<input type="text" id="advisee_state" name="advisee_state" value = '{{$display['advisee_state']}}' class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="address">Postcode</label>
						<input type="text" id="advisee_postcode" name="advisee_postcode" value = '{{$display['advisee_postcode']}}' class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="contact">Contact Number</label>
						<input type="text" id="advisee_contact" name="advisee_contact" value = '{{$display['advisee_contact']}}' class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="email">Email</label>
						<input type="text" id="advisee_email" name="advisee_email" value = '{{$display['advisee_email']}}' class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="cgpa">CGPA</label>
						<input type="text" id="advisee_cgpa" name="advisee_cgpa" value = '{{$display['advisee_cgpa']}}' class="form-control"></input>
					</div>
               <div class="form-group" style='text-align:left'>
						<label for="status">Status</label>
						<!-- <input type="text" id="advisee_status" name="advisee_status" class="form-control" required></input><br> -->
                  <br><center><input class="active-button" type="radio" value="Active" id="advisee_status" name="advisee_status" checked>
                  <label style="color:green" for="active">Active</label>
                  <input class="graduate-button" type="radio" value="graduated" id="advisee_status" name="advisee_status">
                  <label style="color:orange" for="graduated">Graduated</label>
                  <input class="dropout-button" type="radio" value="dropout" id="advisee_status" name="advisee_status">
                  <label style="color:red" for="dropout">Drop Out</label>
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Update Advisee</button>
				</form>
			</div>
</section>

   <!--<footer class="section-sm pb-0 border-top border-default">
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