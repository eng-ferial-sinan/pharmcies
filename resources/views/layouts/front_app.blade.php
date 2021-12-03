@php 

$info= sitinfo();
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>المتجر</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="/frontend/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="/frontend/vendor/font-awesome/css/font-awesome.min.css">
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="/frontend/https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
        <!-- owl carousel-->
        <link rel="stylesheet" href="/frontend/vendor/owl.carousel/assets/owl.carousel.css">
        <link rel="stylesheet" href="/frontend/vendor/owl.carousel/assets/owl.theme.default.css">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="/frontend/css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="/frontend/css/custom.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="/frontend/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css">
        
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
            <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



</head>
<body>
    
            <!-- HEADER AREA START (header-5) -->
    @include('components.header')
    <!-- HEADER AREA END -->
    @include('admin.inc.messages')
    @yield('content')
    @include('components.footer')
    
    <script src="/frontend/vendor/jquery/jquery.min.js"></script>
    <script src="/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="/frontend/js/front.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"> </script>
    <script src="/frontend/js/map.js"></script>
    @yield('script')

</body>
</html>
