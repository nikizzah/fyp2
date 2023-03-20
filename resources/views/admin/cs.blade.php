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

<section class="section">
<br><h4 style = 'margin-left: 20px;'>Course Structure</h4>
<button class="button" ><a style= 'color:black' href='/uploadCourseStructure'>Upload Course Structure</a></button>
	<div class="container">
	<br>
	<table class=table border=2>
                  <tr>
				  	     <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>CGPA</th>
                  </tr>
                  
              </table>
              <center><button class="button" style='margin-leftt:20px'><a href='/createAdvisee' style='color:black'>Create Advisee</a></button>
   </section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>