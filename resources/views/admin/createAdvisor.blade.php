<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

@include('admin.css')
@include('admin.navbar')

<body>
<!-- navigation -->

<!-- /navigation -->
<!-- <a style ='align-item:right'>
<button  class="btn btn-primary">Back</button>
</a> -->

<center><br><br><h4>Create Advisor</h4><br>
<section class="section">
        <div class="col-md-6 form-table">
				<form method="POST" action="#">
					<div class="form-group" style='text-align:left'>
						<label for="id">Staff ID</label>
						<input type="text" name="advisor_id" id="advisor_id" class="form-control">
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="name">Full Name</label>
						<input type="text" name="advisee_name" id="advisee_name" class="form-control">
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="extension">Extension</label>
						<input name="text" id="advisor_ext" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="email">Email</label>
						<input name="text" id="advisor_email" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="position">Position</label>
						<input name="text" id="advisor_position" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="quota">Quota</label>
						<input name="text" id="advisor_quota" class="form-control"></input>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="status">Statur</label>
						<input name="text" id="advisor_status" class="form-control"></input>
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Create Advisor</button>
				</form>
			</div>
</section>

   <footer class="section-sm pb-0 border-top border-default">
      <div class="container">
         <div class="row justify-content-between">
            <!-- <div class="col-md-3 mb-4">
               <a class="mb-4 d-block" href="index.html">
                  <img class="img-fluid" width="150px" src="images/logo.png" alt="LogBook">
               </a>
               <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            </div> -->


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
   </footer>


   <!-- JS Plugins -->
   @include('admin.script')
</body>
</html>