<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('meta-description')">
    {{--<meta name="theme-color" content="{{ settings.color_primary }}">--}}
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('css/extra.css')}}">
    <title>@yield("title", config('app.name', 'Moex'))</title>
    @include('includes.scripts')

    <!-- Fonts -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://max÷cdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> -->


@yield('custom_styles')
</head>

<body>

<div id="app">
    <landing></landing>
</div>

    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/landing.js') }}"></script>
@yield('custom_js')

</html>
