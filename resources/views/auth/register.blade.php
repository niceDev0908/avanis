@extends('layouts.app')
@section('content')
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-8">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Avanis Registration</h5>
                                    <p>You will need your application code to continue.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ URL::asset('public/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="{{ URL::asset('public/assets/images/logo.svg') }}" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            @include('flash-message')
                            <form class="needs-validation" method="post" action="{{ route('save-register') }}" id="registerForm">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Application Code</label>
                                        <input type="text" class="form-control" name="intermediary_code" id="intermediary_code" value="" placeholder="Application Code">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Company</label>
                                        <input type="text" class="form-control" name="company" id="company" value="" placeholder="Company">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Product Type</label>
                                        <select class="form-select" name="product_type" id="product_type">
                                            <option value="RSA">RSA</option>
                                            <option value="CFP">CFP</option>
                                            <option value="GFS">GFS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="useremail" class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="useremail" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="reg_email" id="reg_email" placeholder="Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="useremail" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Address 1</label>
                                        <input type="text" class="form-control" name="address" id="address" value="" placeholder="Address">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Address 2</label>
                                        <input type="text" class="form-control" name="address2" id="address2" value="" placeholder="Address 2">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Town</label>
                                        <input type="text" class="form-control" name="town" id="town" placeholder="Town">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">County</label>
                                        <input type="text" class="form-control" name="county" id="county" value="" placeholder="County">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Postcode</label>
                                        <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="useremail" class="form-label">Country</label>
                                        <select class="form-select" name="country" id="country">
                                            <option selected value="United Kingdom">UK</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="useremail" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="reg_password" id="reg_password" value="" placeholder="Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="useremail" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">
                                        <button class="btn btn-primary waves-effect waves-light loaderClass" type="submit">Register</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <div>
                        <p>Already have an account ? <a href="{{route('login')}}" class="fw-medium text-primary"> Login</a> </p>
                        <p>© <script>document.write(new Date().getFullYear())</script> Avanis.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{URL::asset('public/js/front/register.js')}}"></script>
@endsection