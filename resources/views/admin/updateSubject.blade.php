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

<center><br><br><h4>Update Subject</h4><br>
<button class="button" ><a style= 'color:black' href='/subj'>Back</a></button>
<section class="section">
        <div class="col-md-6 form-table">
				<form method="POST" action="/editSubj">
                    @csrf
                    <div class="form-group" style='text-align:left'>
						<label for="subject_code">Subject Code</label>
						<input type="text" id="subject_code" name="subject_code" value = '{{$display['subject_code']}}' class="form-control" required></input>
					</div>

               <!--from course structure table
					   <div class="form-group" style='text-align:left'>
						<label for="year">Subject Year</label>
						<input type="text" name="subject_year" id="subject_year" class="form-control" required>
					</div>
					<div class="form-group" style='text-align:left'>
						<label for="name">Subject Semester</label>
						<input type="text" name="subject_semester" id="subject_semester" class="form-control" required>
					</div> -->

                    <div class="form-group" style='text-align:left'>
						<label for="name">Subject Name</label>
						<input type="text" name="subject_name" id="subject_name" value = '{{$display['subject_name']}}' class="form-control" required>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="name">Subject Credit Hour</label>
						<input type="text" name="subject_credithr" id="subject_credithr" value = '{{$display['subject_credithr']}}' class="form-control" required>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="name">Subject Category</label>
						<!-- <input type="text" name="subject_category" id="subject_category" class="form-control" required> -->
                  <select name="subject_category" type="text" class="form-control "  required>
                      <center><option value= "{{$display['subject_category']}}">{{$display['subject_category']}}</option>
                      <option value = "Core">Core</option>
                      <option value = "Elective">Elective</option>
                      <option value = "College Compulsory">College Compulsory</option>
                      <option value = "Elective">Elective</option>
                      <option value = "MPU">MPU</option>
                    </select>
					</div>
                    <div class="form-group" style='text-align:left'>
						<label for="name">Pre requisite Subject</label>
						<input type="text" name="subject_prerequisite" id="subject_prerequisite" value =  '{{$display['subject_prerequisite']}}' class="form-control">
					</div>
                    <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                    <button type="submit" class="btn btn-primary">Update Subject</button>
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