@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Reports</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Reports</li>
            </ol>
        </div>
    </div>
</div>

@include('admin.flash-message')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>Transaction Report</h4> 
                <hr /> 
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">From Date</label>
                            <input class="form-control" type="date" name="from_date" id="from_date" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">To Date</label>
                            <input class="form-control" type="date" name="to_date" id="to_date" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Product Type</label>
                            <select class="form-control custom-select" name="product_type" id="product_type">
                                <option value="">Select Product Type</option>
                                <option value="RSA">RSA</option>
                                <option value="CFP">CFP</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">&nbsp;</label><br />
                            <a href="{{route('admin.reports.export')}}" id="download_transactions_report" class="btn btn-dark"><i class="fas fa-download"></i> Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4>User Report</h4> 
                <hr /> 
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">From Date</label>
                            <input class="form-control" type="date" name="u_from_date" id="u_from_date" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">To Date</label>
                            <input class="form-control" type="date" name="u_to_date" id="u_to_date" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">&nbsp;</label><br />
                            <a href="{{route('admin.users.export')}}" id="download_user_transactions_report" class="btn btn-dark"><i class="fas fa-download"></i> Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/report.js')}}"></script>
@endsection