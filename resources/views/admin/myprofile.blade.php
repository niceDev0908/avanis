@extends('admin.layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">My Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form name="frmCreateEdit" id="frmCreateEdit" method="post" action="{{ route('admin.myprofile-action') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{Auth::user()->id}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{Auth::user()->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{Auth::user()->last_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{Auth::user()->username}}" disabled="disabled">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <input type="password" name="c_password" id="c_password" class="form-control">
                                </div>
                            </div>
                        </div>
<!--                        <div class="row" style="" id="image_file_div">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Photo</label>
                                    <input type="hidden" name="input_old_name" value="{{Auth::user()->image}}">
                                    <input type="file" name="image_file_name" id="file_name" class="form-control" value="{{Auth::user()->image}}" accept = "image/png, image/jpeg ,image/jpg">
                                </div>
                            </div>
                            @if(Auth::user()->image)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <img src="{{URL::to('/')}}/public/uploads/users/{{Auth::user()->id . '/' . Auth::user()->image}}" alt="user" class="" style="height: 100px; width: 100px;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-dark delete_image" title="Delete" href="{{route('admin.myprofile-delete-image', Auth::user()->id)}}">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </a>
                            </div>
                            @else
                            <div class="col-md-6"></div>
                            @endif
                        </div>-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{URL::asset('public/js/myprofile.js')}}"></script>
@endsection