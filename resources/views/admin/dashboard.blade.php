@extends('admin.layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Dashboard</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">CFP Users</h5>
                <div class="text-right"> <span class="text-muted">Total</span>
                    <h2>
                        <!-- <sup><i class="ti-arrow-up text-success"></i></sup> -->
                        {{$data['cfp_users']}}
                    </h2>
                </div>
                <!-- <span class="text-success">20%</span>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: 20%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">RSA Users</h5>
                <div class="text-right"> <span class="text-muted">Total</span>
                    <h2>
                        <!-- <sup><i class="ti-arrow-up text-success"></i></sup> -->
                        {{$data['rsa_users']}}
                    </h2>
                </div>
                <!-- <span class="text-success">20%</span>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: 20%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">GFS Users</h5>
                <div class="text-right"> <span class="text-muted">Total</span>
                    <h2>
                        <!-- <sup><i class="ti-arrow-up text-success"></i></sup> -->
                        {{$data['gfs_users']}}
                    </h2>
                </div>
                <!-- <span class="text-success">20%</span>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: 20%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                </div> -->
            </div>
        </div>
    </div>
    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Intermediary</h5>
                <div class="text-right"> <span class="text-muted">Total</span>
                    <h2>
                        {{$data['intermediary']}}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection