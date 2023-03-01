@extends('layouts.app')
@section('content')
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
                                                            <p class="font-size-16 mb-4" style="color: #FFF;">You will need to obtain an application code from your financial representative before registering your Avanis membership</p>
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
                                <div>
                                    <h5 class="text-primary">Welcome</h5>
                                    <p class="text-muted">Sign in to continue to Avanis.</p>
                                </div>
                                <div class="mt-4">
                                    @include('flash-message')
                                    <form method="post" action="{{ route('login') }}" id="loginForm">
                                        @csrf
                                        <?php
                                        $email = Cookie::get('avanis_email');
                                        $password = Cookie::get('avanis_password');
                                        $remember = Cookie::get('avanis_remember');
                                        ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email" id="email" value="{{ isset($email) ? $email : ''  }}" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="{{route('forgot-password')}}" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="{{ isset($password) ? $password : ''  }}" placeholder="Password">
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light loaderClass" type="submit">Log In</button>
                                        </div>
                                    </form>
                                    <div class="mt-5 text-center">
                                        <p>Not a member ? <a href="{{route('register')}}" class="fw-medium text-primary"> Signup now </a> </p>
                                    </div>
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
@endsection
@section('javascript')
<script type="text/javascript" src="{{URL::asset('public/js/front/login.js')}}"></script>
@endsection