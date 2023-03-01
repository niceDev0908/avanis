@extends('admin.layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ $data->id > 0 ? 'Edit' : 'Add' }} Setting</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.settings')}}">Scrollbar</a></li>
                <li class="breadcrumb-item active">{{ $data->id > 0 ? 'Edit' : 'Add' }} Setting</li>
            </ol>
            <a class="btn btn-dark d-none d-lg-block m-l-15" href="{{ route('admin.settings') }}">Back</a>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form name="frmCreateEdit" id="frmCreateEdit" method="post" action="{{ route('admin.settings.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Setting Name</label>
                                    <input type="text" value="{{$data->setting_name}}" class="form-control" name="setting_name" id="setting_name" readonly>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Slug</label>
                                    <input type="text" value="{{$data->setting_slug}}" class="form-control" name="setting_slug" id="setting_slug" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Setting Status</label>
                                    <select class="form-control custom-select" name="setting_value" id="setting_value">
                                        <option value="" {{ $data->setting_value === '' ? 'selected' : '' }}>Select Status</option>
                                        <option value="1" {{ $data->setting_value == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $data->setting_value == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                            <a class="btn btn-dark" href="{{ route('admin.settings') }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/settings.js')}}"></script>
@endsection