<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{ asset('website/assets/favicon.ico') }}">

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('website/assets/plugins/fontawesome/js/all.min.js') }}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('website/assets/css/portal.css') }}">

</head>

<body class="app">
@include('components.sidebar')
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
         @yield('user-content')
          @include('components.footer')
        </div>
    </div>
</div>


    <!-- Javascript -->
    <script src="{{ asset('website/assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('website/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Charts JS -->
    <script src="{{ asset('website/assets/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/index-charts.js') }}"></script>

    <!-- Page Specific JS -->
    <script src="{{ asset('website/assets/js/app.js') }}"></script>

</body>
</html>
