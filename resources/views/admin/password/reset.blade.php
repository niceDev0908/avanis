<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/jpeg" sizes="32x32" href="{{ URL::asset('public/tj-assets/images/ico/favicon.png') }}">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- CSS Starts -->
        <link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet">
        <!-- CSS Ends -->

        <!-- Script Starts -->
        <script src="{{ URL::asset('public/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- Script Ends -->
        <script type="text/javascript">
var base_url = "{{URL::to('/')}}/admin/";
        </script>
    </head>
    <body class="skin-default card-no-border">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">{{ config('app.name') }}</p>
            </div>
        </div>
        <section id="wrapper">
            <div class="login-register" style="background-image:url({{ URL::asset('public/images/login-register.jpg') }});">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 flash-message">
                        @foreach (['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'dark'] as $msg)
                        @if(Session::has($msg))
                        <div class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</div>
                        @endif
                        @endforeach
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="login-box card">
                    <div class="login-themebg">
                        <img src="{{URL::asset('public/images/logo.svg')}}" style="width: 150px; height: 100%;" />
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal form-material" id="resetpasswordform" action="{{route('admin-reset-password-action')}}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" id="password" name="password" utocomplete="current-password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" utocomplete="current-password" required="" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12">
                                    <button class="btn btn-block btn-lg btn-rounded btn-green" type="submit">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{URL::asset('public/js/admin/reset.js')}}"></script>
        <script type="text/javascript">
            jQuery(function () {
                jQuery(".preloader").fadeOut();
            });
            jQuery(function () {
                jQuery('[data-toggle="tooltip"]').tooltip();
            });
            jQuery('#to-recover').on("click", function () {
                jQuery("#loginform").slideUp();
                jQuery("#recoverform").fadeIn();
            });
        </script>
    </body>
</html>