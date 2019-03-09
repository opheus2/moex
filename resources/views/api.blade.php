<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('meta-description')">
    {{--<meta name="theme-color" content="{{ settings.color_primary }}">--}}
    <link rel="shortcut icon" type="image/x-icon" href="{{config('app.shortcut_icon') ?: asset('/images/icon/favicon.ico')}}">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/error.css')}}">
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('css/extra.css')}}">
    <link rel="stylesheet" href="{{asset('css/external.css')}}">
    <title>@yield("title", config('app.name', 'Moex'))</title>
    @include('includes.scripts')

    <!-- Fonts -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://max÷cdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> -->
@yield('custom_styles')
<style >
  #navbar {
    background: #1B264B;
    border-radius: 0px;
    display: flex;
    justify-content: center;
  }
  .banner {
    display: flex;
    justify-content: center;
  }
</style>


</head>

<body>
  <div class="">
    @include('includes.navbar')
    <div class="banner">
        <div class="row center">
            <h6 class="policy">API Documentation</h6>
            <h6 class="read">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, est eleifend scelerisque tristique.</h6>
        </div>
    </div>
    <div class="containers">
      <div class="api-inner">
        <div class="api-flex-tab container-fluid">
          <div class="row">
            <div class="left col-xs-12 col-md-4">
              <p class="title">Table of content</p>
              <div class="list-group">
                <a href="#" class="list-group-item active">General</a>
                <a href="#" class="list-group-item">Blogs &amp; Posts</a>
                <a href="#" class="list-group-item">Fees &amp; Charges</a>
                <a href="#" class="list-group-item">Safety &amp; Security</a>
                <a href="#" class="list-group-item">Mobile App</a>
                <a href="#" class="list-group-item">More Questions?</a>
              </div>
            </div>
            <div class="right col-xs-12 col-md-8">
              <p class="title">General</p>
              <p class="body">
                t is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                distribution of letters, as opposed to using 'Content here, content here',
                making it look like readable English. Many desktop publishing packages and web page editors now
                use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
                sometimes on purpose (injected humour and the like).<br><br>
                t is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                distribution of letters, as opposed to using 'Content here, content here',
                making it look like readable English. Many desktop publishing packages and web page editors now
                use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
                sometimes on purpose (injected humour and the like).<br><br>
                t is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                distribution of letters, as opposed to using 'Content here, content here',
                making it look like readable English. Many desktop publishing packages and web page editors now
                use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
                sometimes on purpose (injected humour and the like).<br><br>
                t is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                distribution of letters, as opposed to using 'Content here, content here',
                making it look like readable English. Many desktop publishing packages and web page editors now
                use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
                sometimes on purpose (injected humour and the like).<br><br>
                t is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                distribution of letters, as opposed to using 'Content here, content here',
                making it look like readable English. Many desktop publishing packages and web page editors now
                use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
                sometimes on purpose (injected humour and the like).<br><br>
              </p>
            </div>
          </div>
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

  </div>
</body>

<script>
    window._isOffline = {{is_null(auth::user()) }}
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/landing.js') }}"></script>
@yield('custom_js')
</html>
