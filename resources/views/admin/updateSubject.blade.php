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

<center><br><br><h4>Update Subject</h4><br>
<button class="button" ><a style= 'color:white' href='/subj'>Back</a></button>
<section class="section">
   <div class="col-md-6 form-table">
		<form method="POST" action="/editSubj">
         @csrf
         <div class="form-group" style='text-align:left'>
				<label for="subject_code">Subject Code</label>
				<input type="text" id="subject_code" name="subject_code" value = '{{$display->subject_code}}' class="form-control" required></input>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="name">Subject Name <a style="color:red">*</a></label>
				<input type="text" name="subject_name" id="subject_name" value = '{{$display->subject_name}}' class="form-control" required>
			</div>
         <div class="form-group" style='text-align:left'>
				<label for="name">Subject Credit Hour <a style="color:red">*</a></label>
				<input type="text" name="subject_credithr" id="subject_credithr" value = '{{$display->subject_credithr}}' class="form-control" required>
            <span class="text-danger">@error('subject_credithr')  {{$message}} @enderror</span>
         </div>
         <div class="form-group" style='text-align:left'>
				<label for="name">Subject Category <a style="color:red">*</a></label>
            <select name="subject_category" type="text" class="form-control "  required>
               <center><option value= "{{$display->subject_category}}">{{$display->subject_category}}</option>
                       <option value = "Core">Core</option>
                       <option value = "Elective">Elective</option>
                       <option value = "College Compulsory">College Compulsory</option>
                       <option value = "MPU">MPU</option>
            </select>
			</div>
         <div class="form-group" style='text-align:left'>
			   <label for="name">Pre requisite Subject <a style="color:red">*</a></label>
				<input type="text" name="subject_prerequisite" id="subject_prerequisite" value =  '{{$display->subject_prerequisite}}' class="form-control">
			</div>
         <button type="submit" class="btn btn-primary">Update Subject</button>
		</form>
	</div>
</section>

   <!-- JS Plugins -->
   @include('script')
</body>
</html>