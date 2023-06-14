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
</style>
</head>
@include('hop.navbar')

<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Advisor</h4>
<center><div class="container ">
<div style = 'margin-left: 700px;'>
    <div class="search">
    <form action="/searchAdvisor" method="get">
        <input name="searchAdvisor" type="search" placeholder="Search Advisor" required>
        <button style= "border:none; background:transparent" type= submit><i class="ti-search" aria-hidden ="true"></i></input>
    </form>
        </div>
</div>
<br><h5 style = 'margin-left: 20px;'>Advisors</h5><br>
               
@if(isset($advisor))
  <table style='background-color:#F6EEE0' class=table border>
    @if(count($advisor) > 0)
      <tr>
        <th>&nbsp;</th>
        <th>Advisee Amount</th>
        <th>Advisor Name</th>
        <th>Advisor Position</th>
      </tr>
      @foreach ($advisor as $display)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a style="color:black" href = {{"Adviseeassigned/".$display['advisor_id']}}>{{$display["advisor_quota"]}}</td>
        <td><a style="color:black" href = {{"infoAdvisor/".$display['advisor_id']}}>{{$display["advisor_name"]}}</td>
        <td><a style="color:black" href = {{"infoAdvisor/".$display['advisor_id']}}>{{$display["advisor_position"]}}</td>
			</tr>
      @endforeach
    @else
      <tr><td style="font-size: 15px">No result found!</td></tr>
    @endif    
</table>
@endif
<br>
  <div id="containerGRAPH"></div>
  <script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>
  <script>
    anychart.onDocumentReady(function() {

      // the data
      var data = {
        header: ["Advisor Name", "Advisees Amount"],
        rows: [
          @foreach ($advisor as $display)
            ["{{$display['advisor_name']}}", {{$display['advisor_quota']}}],
          @endforeach
        ]
      };

      // create the chart
      chart = anychart.column();

      // add the data
      chart.data(data);

      // change colour
      chart.palette(["#A45C40"]);
      chart.title().fontColor("black"); 
      chart.xAxis().labels().fontColor("black");
      chart.yAxis().labels().fontColor("black");
      chart.xAxis().stroke("black"); 
      chart.yAxis().stroke("black");
      chart.background().fill("transparent");

      // set the chart title
      chart.title("Advisor Advisee Assignment");

      // set the container for the chart
      chart.container('containerGRAPH');

      // draw the chart
      chart.draw();

      chart.yScale().minimum(0);       
    });
  </script>

</div>
</center>
</section>

  <!-- JS Plugins -->
  @include('script')
</body>

</html>