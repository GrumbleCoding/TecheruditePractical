<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="{{asset('/assets/landing/images/brand.png')}}" rel="icon" class="favicon" />
    <title>Techerudite | @yield('title')</title>

    @yield('page-css')
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/landing/vendors/bootstrap/css/bootstrap.min.css')}}" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/landing/css/main.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/landing/css/responsive.css')}}" />
    <?php
        $currentRouteName = request()->route()->getName();
    ?>
    <script>
         var currentRouteName = '{{$currentRouteName}}'
         var globalSiteUrl = '<?php echo $path = url('/'); ?>';
    </script>
</head>
<body>
<!-- HEADER -->
@include('layouts.landing.header')
<!-- MAIN SECTIONS -->
@yield('content')
<!-- FOOTER -->
@if(!in_array($currentRouteName,['login','signup','user.forgot_password', 'otp_verification', 'user.reset_password']))
@include('layouts.landing.footer')
@endif
<!-- MODALS -->
@include('modals.logout')
</body>
<!-- Bootstrap JS & Jquery -->
<script src="{{asset('/assets/landing/vendors/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/assets/landing/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Custom Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
{{-- <script src="{{asset('/assets/landing/js/main.js')}}"></script> --}}

<script>
    $(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });

    $(".alert-danger").fadeTo(4000, 500).slideUp(500, function(){
        $(".alert-danger").slideUp(500);
    });
</script>
@yield('page-js')
</html>
