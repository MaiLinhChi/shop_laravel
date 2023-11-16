<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')
    <link href="/Eshopper/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Eshopper/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Eshopper/css/prettyPhoto.css" rel="stylesheet">
    <link href="/Eshopper/css/price-range.css" rel="stylesheet">
    <link href="/Eshopper/css/animate.css" rel="stylesheet">
	<link href="/Eshopper/css/main.css" rel="stylesheet">

  @yield('css')
</head>
<body>
  @include('client.home.components.header')

  @include('client.home.components.sidebar')

  @yield('content')

  @include('client.home.components.footer')
  @yield('js')
  <script src="/Eshopper/js/jquery.js"></script>
  <script src="/Eshopper/js/bootstrap.min.js"></script>
  <script src="/Eshopper/js/jquery.scrollUp.min.js"></script>
  <script src="/Eshopper/js/price-range.js"></script>
  <script src="/Eshopper/js/jquery.prettyPhoto.js"></script>
  <script src="/Eshopper/js/main.js"></script>
</body>
</html>
