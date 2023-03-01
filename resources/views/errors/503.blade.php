<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Avanis</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Avanis" />
        <meta name="keywords" content="Avanis" />
        <meta name="author" content="avanis.co.uk">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <link rel="shortcut icon" href="{{URL::asset('public/tj-assets/images/ico/favicon.png')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/bootstrap/css/bootstrap.min.css')}}" media="screen">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/css/main.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/css/component.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/icons/linearicons/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/icons/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/icons/rivolicons/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/css/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/tj-assets/css/responsive.css')}}">
    </head>
    <body class="{{(Route::currentRouteName() == 'home' ? 'home' : 'not-transparent-header')}}">
        <div class="container-wrapper">
            <header id="header">
                <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">
                    <div class="container">
                        <div class="logo-wrapper">
                            <div class="logo">
                                <a href="{{ url('/') }}"><img src="{{URL::asset('public/images/logo-dark.jpeg')}}" style="height: 43px;" alt="Logo" class="responsive-logo" /></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="main-wrapper">
                <div class="error-page-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                                <h3>THE SITE IS UNDER DEVELOPMENT AT THE MOMENT.</h3>
                                <p>For more information please email <a href = "mailto: support@avanis.co.uk">support@avanis.co.uk</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Avanis.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>