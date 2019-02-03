<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <title>{{__('Page Not Found!')}} | {{config('app.name')}}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('meta-description')">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('css/extra.css')}}">
    <link rel="stylesheet" href="{{asset('css/error.css')}}">
    <style>

    </style>
</head>

<body>
  @include('includes.navbar')

    <div class="error-div">
      <div class="">
        <div class="d-flex justify-content-center">
          <img src="images/404.svg" alt="404" style="width:50%; height:50vh">
        </div>
        <p class="error-message">Oh No! Seems this page is broken</p>
        <div class="" style="width:100%; text-align:center">
          <a href="#">Go Back</a>
        </div>
      </div>
    </div>
    <div class="trading">
      <div class="">
        <p>Start Trading</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis luctus sodales. </p>
        <div class="d-flex justify-content-center">
          <a class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a>
        </div>
      </div>
    </div>
    @include('includes.footer')
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
