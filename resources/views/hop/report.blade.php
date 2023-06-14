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
<br><h4 style = 'margin-left: 20px;'>Report</h4>
<div class="container ">
  <div>
  <br>
    <table style='background-color:#F6EEE0' class=table border>
    <thead>
       <tr>
          <th>Advisor Position</th>
          <th>Assigned</th>
          <th>Percentage</th>
       </tr>
    </thead>
    <tbody>
    @foreach ($reportData as $key => $data)
          <tr>
          <td>{{ $data['advisorPosition']->advisor_position }}</td>
          <td>{{ $data['quota'] }} / {{ $data['totalAdvisees'] }}</td>
          <td>{{ $data['percentage'] }}%</td>
       </tr>
    @endforeach
    </tbody>
    </table>
  </div>
</div>
</section>
   <!-- JS Plugins -->
   @include('script')
</body>
</html>