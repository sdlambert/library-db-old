<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Library DB </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">     <!--  <meta property="og:type" content="">-->
    <!--  <meta property="og:url" content="">-->
    <!--  <meta property="og:image" content="">-->

    <!--  <link rel="manifest" href="site.webmanifest">-->
    <!--  <link rel="apple-touch-icon" href="icon.png">-->
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/css/app.css">

    <!--  <meta name="theme-color" content="#fafafa">-->
</head>

<body>
    {!! file_get_contents('images/sprite.svg') !!}
    @include('includes.header')

    <div id="app">

        @yield('content')

    </div>

    @include('includes.footer')

</body>

</html>
