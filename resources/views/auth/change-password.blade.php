@extends('layouts.app')
@section('content')
<div id="layout-wrapper">
    @include('layouts.header')
    @include('layouts.left-sidebar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Change Password</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">Change Password</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @include('flash-message')
                                <form class="needs-validation" method="post" action="{{ route('change-password-action') }}" id="changePasswordForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="useremail" class="form-label">Current Password</label>
                                            <input class="form-control" type="password" name="current_password" id="current_password">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="useremail" class="form-label">New Password</label>
                                            <input class="form-control" type="password" name="new_password"  id="new_password">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="useremail" class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="new_confirm_password" id="new_confirm_password">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">
                                            <button class="btn btn-primary waves-effect waves-light loaderClass" type="submit">Save</button>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/front/change-password.js')}}"></script>
@endsection