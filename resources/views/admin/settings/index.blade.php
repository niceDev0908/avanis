@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Settings</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">Setting Name</th>
                                <th width="10%">Slug</th>
                                <th width="5%" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($data ?? '' as $key => $v)
                            <tr id="row_{{$v->id}}">
                            	<td>{{$v->setting_name}}</td>
                            	<td>{{$v->setting_slug}}</td>
                            	<td style="text-align: center;">
                            		<a class="btn btn-primary" title="Edit" href="{{route('admin.settings.edit',$v->id)}}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                            	</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/settings.js')}}"></script>
@endsection