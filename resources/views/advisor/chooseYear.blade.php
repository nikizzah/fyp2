<!DOCTYPE html>
<!--
// WEBSITE: https://themefisher.com
// TWITTER: https://twitter.com/themefisher
// FACEBOOK: https://www.facebook.com/themefisher
// GITHUB: https://github.com/themefisher/
-->
<html lang="en-us">

@include('css')
@include('advisor.navbar')

<body>
   <section class="section">
      <br>
      <h4 style='margin-left: 20px;'>Advisor Planning </h4><br>
      <form method="POST" action="/planningAdvisor">
         @csrf
         <div style="display: flex; align-items: center;margin-left: 50px;">
            <a style="color:black; font-size:17px;">Student Name: </a>
            <input name='advisee_fname' value="{{$display['advisee_fname']}}" style="font-size:17px; border:none; background-color:transparent; color:#A45C40;" readonly >
            </input>&nbsp;&nbsp;&nbsp;&nbsp;
            <a style="color:black; font-size:17px;">Student ID: </a>
            <input name='advisee_id' value="{{$display['advisee_id']}}" style="font-size:17px; border:none; background-color:transparent; color:#A45C40;" readonly >
            </input>&nbsp;
         </div>
         <center>
            <div style="margin-top: 70px;" class="col-md-3 ">
               <div class="form-group" style='text-align:left'>
                  <label for="name">Year: </label>
                  <select name="year" type="text" class="form-control " required>
                     <center>
                        <option value=" ">Select Year</option>
                        @foreach ($subjects as $value)
                        <option value="{{$value->subject_year}}">{{$value->subject_year}}</option>
                        @endforeach
                  </select>
               </div>
               <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
      </form>
      </div>
   </section>
   <!-- JS Plugins -->
   @include('script')
</body>

</html>
