@extends('layouts.app')

@section('content')
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary"> Reset Password</h5>
                                    <p>Re-Password with Avanis.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ URL::asset('public/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ URL::asset('public/assets/images/logo.svg') }}" alt="" class="rounded-circle" height="34">
                                </span>
                            </div>
                        </div>

                        <div class="p-2">
                            <div class="alert alert-success text-center mb-4" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>
                            <form class="form-horizontal" method="post" action="{{ route('forgot-password-action') }}" id="ForgotPasswordForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email</label>
                                    <input class="form-control" type="email" name="forgot_email" id="forgot_email" placeholder="Email">
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-primary w-md waves-effect waves-light loaderClass" type="submit">Reset</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Remember It ? <a href="{{route('login')}}" class="fw-medium text-primary"> Sign In here</a> </p>
                    <p>© <script>document.write(new Date().getFullYear())</script> Avanis.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{URL::asset('public/js/front/common.js')}}"></script>
@endsection