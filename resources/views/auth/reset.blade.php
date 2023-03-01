@extends('layouts.app')

@section('content')
<!-- <section class="imagebg height-50 section-hero-1 bg--primary" data-overlay="7">
    <div class="background-image-holder">
        <img alt="image" src="{{URL::asset('public/images/home1.jpg')}}" />
    </div>
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h3>Reset Password</h3>
            </div>
        </div>
    </div>
</section> -->
<section class="page-title section--pullup bg--secondary">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Reset Password</li>
                </ol>
                <hr>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                @include('flash-message')
                <form class="form-email" method="post" action="{{ route('reset-password-actions') }}" id="resetPasswordForm">
                    @csrf
                    <input type="hidden" name="reset_token" value="{{ $token }}">
                    <input type="hidden" name="reset_email" value="{{ $email }}">
                    <div class="boxed">
                        <div class="row">
                            <p class="lead" style="font-size: 15px;text-align: center;">Please enter the password to generate a new password.</p>
                            <div class="col-sm-12 text-center">
                                <div>
                                    <label>Password:</label>
                                    <input class="validate-required" type="password" id="password_reset" name="password_reset" type="password" placeholder="Password" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div>
                                    <label>Confirm Password:</label>
                                    <input class="validate-required" id="confirm_password_reset" name="confirm_password_reset" type="password" placeholder="Confirm Password" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn">
                                    <span class="btn__text">
                                        Reset Password
                                    </span>
                                </button>                       
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script type="text/javascript" src="{{URL::asset('public/js/front/common.js')}}"></script>
@endsection