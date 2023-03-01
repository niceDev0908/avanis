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
                            <h4 class="mb-sm-0 font-size-18">Personal Details</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">Personal Details</li>
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
                                <form class="needs-validation" method="post" action="{{route('manage-profile-action')}}" id="manageProfileForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{$data->first_name}}" placeholder="First Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{$data->last_name}}" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Company</label>
                                            <input type="text" class="form-control" name="company" id="company" value="{{$data->company}}" placeholder="Company">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{$data->email}}" placeholder="Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="useremail" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{$data->phone_number}}" placeholder="Phone Number">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Address 1</label>
                                            <input type="text" class="form-control" name="address" id="address" value="{{$data->address}}" placeholder="Address">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Address 2</label>
                                            <input type="text" class="form-control" name="address2" id="address2" value="{{$data->address2}}" placeholder="Address 2">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Town</label>
                                            <input type="text" class="form-control" name="town" id="town" value="{{$data->town}}" placeholder="Town">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">County</label>
                                            <input type="text" class="form-control" name="county" id="county" value="{{$data->county}}" placeholder="County">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Postcode</label>
                                            <input type="text" class="form-control" name="postcode" id="postcode" value="{{$data->postcode}}" placeholder="Postcode">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="useremail" class="form-label">Country</label>
                                            <select class="form-select" name="country" id="country">
                                                <option selected value="United Kingdom">UK</option>
                                            </select>
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
<script src="{{URL::asset('public/js/front/profile.js')}}"></script>
@endsection