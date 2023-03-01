<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{URL::asset('public/images/favicon.ico')}}" type="image/x-icon">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- CSS Starts -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/style.css') }}">
        <link href="{{ URL::asset('public/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('public/assets/libs/croppie/croppie.css') }}">
        <link rel="stylesheet" href="{{URL::asset('public/assets/libs/bootstrap3-wysihtml5-npm/bootstrap3-wysihtml5.min.css')}}" />
        <link href="{{URL::asset('public/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css"/> 
        <!-- CSS Ends -->

        <!-- Script Starts -->
        <script src="{{ URL::asset('public/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/additional-methods.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{URL::asset('public/js/admin/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{URL::asset('public/js/admin/sidebarmenu.js')}}"></script>
        <script src="{{URL::asset('public/js/admin/custom.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('public/assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript">
        var base_url = "{{URL::to('/')}}/admin/";
        $("input").each(function (index) {
            $(this).attr('tabindex', index+1);
        });
        </script>
        <!-- Script Ends -->
    </head>
    <body class="skin-blue fixed-layout">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">{{ config('app.name') }}</p>
            </div>
        </div>
        <div id="main-wrapper">
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')
            <div class="page-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </body>
    @yield('javascript')
</html>