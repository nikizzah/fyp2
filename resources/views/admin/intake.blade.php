<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">
<head>
<meta charset="utf-8">
   <title>UNITEN Advisory and Study Planner</title>

   <!-- mobile responsive meta -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
   <meta name="description" content="This is meta description">
   <meta name="author" content="Themefisher">
 
   <!-- theme meta -->
   <meta name="theme-name" content="logbook" />

   <!-- plugins -->
   <link rel="preload" href="{{url('https://fonts.gstatic.com/s/opensans/v18/mem8YaGs126MiZpBA-UFWJ0bbck.woff2')}}" style="font-display: optional;">
   <link rel="stylesheet" href="{{url('theme/plugins/bootstrap/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{url('https://fonts.googleapis.com/css?family=Montserrat:600%7cOpen&#43;Sans&amp;display=swap')}}" media="screen">
   
   <link rel="stylesheet" href="{{url('theme/plugins/themify-icons/themify-icons.css')}}">
   <link rel="stylesheet" href="{{url('theme/plugins/slick/slick.css')}}">

   <!-- Main Stylesheet -->
   <link rel="stylesheet" href="{{url('theme/css/style.css')}}">

   <!--Favicon-->
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
   <link rel="icon" href="images/favicon.png" type="image/x-icon">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <style>
    ::placeholder {
        color: black;
    }
    a {
        color:black;
    }
    a:hover {
        color: #A45C40;
        text-decoration:underline ;
        font-weight:bold;
    }
    </style>
@livewireStyles
</head>
@include('admin.navbar')
<body>
<section class="section">
<br><h4 style = 'margin-left: 20px;'>Course Structure</h4>
<button class="button" ><a style= 'color:white ;background-color:transparent; text-decoration:none' href='/assignintake'>Back</a></button>
	<div class="container">
    <br><br>
<div class="container containerIntake ">

  @livewire('c-s')
  </div>
  </div>
  </section>

   <!-- JS Plugins -->
   @include('script')
    @livewireScripts
</body>
</html>