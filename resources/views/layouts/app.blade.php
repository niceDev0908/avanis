<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Avanis Portal: Login | RSA | CFP</title>
        <link rel="shortcut icon" href="{{URL::asset('public/images/favicon.ico')}}" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <link href="{{ URL::asset('public/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('public/assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/assets/libs/dropzone/min/dropzone.min.css') }}">
        <link href="{{ URL::asset('public/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <style>
.yyyyy {}
            body[data-sidebar=dark] .vertical-menu {
                background: #0E2B3D;
            }
            body[data-sidebar=dark] .navbar-brand-box {
                background: #0E2B3D;
            }
            .auth-full-bg .bg-overlay {
                background-color: #0E2B3D;
            }
            /* .avanisLoader img {
                position: absolute;
                top: 35%;
                left: 55%;
                transform: translate(-50%, -50%);
                width: 10%;
                z-index: 99;
            } */
        </style>
        @yield('style')
    </head>
    <body data-sidebar="dark">
        <?php 
            if(Route::is('register'))
                $class = 'registerLoader';
            else if(Route::is('home'))
                $class = 'loginLoader';
            else if(Route::is('forgot-password'))
                $class = 'forgotLoader';
            else
                $class = 'avanisLoader';
        ?>
        <div class="{{$class}}" style="display:none;">
            <img src="{{ URL::asset('public/images/avanisLoader.gif') }}">
        </div>
        @yield('content')

        <script src="{{ URL::asset('public/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/js/pages/auth-2-carousel.init.js') }}"></script>
        <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/select2/js/select2.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/additional-methods.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript">
            var base_url = "{{URL::to('/')}}/";
            function getPrice(amount) {
                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'GBP',
                });

                var final_amt = formatter.format(amount);
                var last3 = final_amt.substr(final_amt.length - 2);
                if (last3 == ".00") {
                    final_amt = final_amt.replace(".00", "");
                }
                
                return final_amt;
            }
        </script>
        @yield('javascript')
    </body>
</html>