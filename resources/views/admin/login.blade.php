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
        <link rel="stylesheet" href="{{ URL::asset('public/assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
        <style>
            body[data-sidebar=dark] .vertical-menu {
                background: #0E2B3D;
            }
            body[data-sidebar=dark] .navbar-brand-box {
                background: #0E2B3D;
            }
            .auth-full-bg .bg-overlay {
                background-color: #0E2B3D;
            }
        </style>
    </head>
    <body data-sidebar="dark">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xl-9">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">
                                    <div class="p-4 mt-auto">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-7">
                                                <div class="text-center">
                                                    <div dir="ltr">
                                                        <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                            <div class="item">
                                                                <div class="py-3">
<!--                                                                    <p class="font-size-16 mb-4" style="color: #FFF;">You will need to obtain an application code from your financial representative before registering your Avanis membership</p>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="{{URL::to('/')}}" class="d-block auth-logo">
                                            <img src="{{ URL::asset('public/images/logo-dark.jpeg') }}" alt="" class="auth-logo-dark">
                                            <img src="{{ URL::asset('public/images/logo-dark.jpeg') }}" alt="" class="auth-logo-light">
                                        </a>
                                    </div>
                                    <div class="my-auto">
                                        <div id="welcome_login">
                                            <h5 class="text-primary">Introducer Login</h5>
                                            <p class="text-muted">Sign in to continue to Avanis.</p>
                                        </div>
                                        <div id="welcome_forgot" style="display: none;">
                                            <h5 class="text-primary">Introducer Forgot Password</h5>
                                            <p class="text-muted">Enter email to continue.</p>
                                        </div>
                                        <div class="mt-4">
                                            @include('flash-message')
                                            <form method="post" action="{{ route('admin-login-action') }}" id="loginform">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username" required="">
                                                </div>
                                                <div class="mb-3">
<!--                                                    <div class="float-end">
                                                        <a href="javascript:void(0);" id="forgot_password" class="text-muted">Forgot password?</a>
                                                    </div>-->
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                                                </div>
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </form>
                                            <form method="post" action="{{ route('admin-forgot-password-action') }}" id="forgotpasswordform" style="display: none;">
                                                @csrf
                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="javascript:void(0);" id="back_to_login" class="text-muted">Back to login</a>
                                                    </div>
                                                    <label for="username" class="form-label">Email</label>
                                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email" required="">
                                                </div>
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Avanis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        <script src="{{ URL::asset('public/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/js/pages/auth-2-carousel.init.js') }}"></script>
        <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('public/assets/libs/jquery-validation/additional-methods.min.js') }}"></script>
        <script type="text/javascript">
                                            var base_url = "{{URL::to('/')}}/";
                                            $('#forgot_password').click(function () {
                                                $('#welcome_login').hide();
                                                $('#welcome_forgot').show();
                                                $('#loginform').hide();
                                                $('#forgotpasswordform').show();
                                            });
                                            $('#back_to_login').click(function () {
                                                $('#welcome_login').show();
                                                $('#welcome_forgot').hide();
                                                $('#loginform').show();
                                                $('#forgotpasswordform').hide();
                                            });
        </script>
    </body>
</html>