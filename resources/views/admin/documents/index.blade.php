@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">User Actions ({{ $user_data->first_name }} {{ $user_data->last_name }})</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Users</a></li>
                <li class="breadcrumb-item active">User Actions</li>
            </ol>
            @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
            <a class="btn btn-primary d-none d-lg-block m-l-15" href="{{route('admin.users.documents.create',$user_id)}}"><i class="fa fa-plus-circle"></i> Add User Action</a>
            @endif
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="p-l-25">
                    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                    <a href="javascript:void(0);" class="btn btn-success" id="btn-all-active" action="Active"><i class="fas fa-check"></i> Active</a>
                    <a href="javascript:void(0);" class="btn btn-danger" id="btn-all-inactive" action="Inactive"><i class="fas fa-times"></i> Inactive</a>
                    <a href="javascript:void(0);" class="btn btn-dark" id="btn-all-delete"><i class="fas fa-trash"></i> Delete</a>
                    @endif
                </h6> 
                <div class="table-responsive">
                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkall" aria-invalid="false">
                                        <label class="custom-control-label" for="checkall"></label>
                                    </div>
                                </th>
                                <th width="10%">Receivable</th>
                                <th width="55%">Title</th>
                                <th width="10%" style="text-align: center;">Is Request Document?</th>
                                <th width="10%" style="text-align: center;">Action Status</th>
                                <th width="10%" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $v)
                            <tr id="row_{{$v->id}}">
                                <td style="text-align: center;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input cb-element" name="chk{{$v->id}}" id="chk{{$v->id}}" value="{{$v->id}}" aria-invalid="false">
                                        <label class="custom-control-label" for="chk{{$v->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    @if($v->receivable_id == 0)
                                    Other
                                    @else
                                    £ {{ @$v->receivable->amount}} - {{ getFormatedDate(@$v->receivable->date)}}
                                    @endif
                                </td>
                                <td>{{ $v->title}}</td>
                                <td style="text-align: center;">
                                    @if($v->is_request_document == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if($v->action_status == 0)
                                    <span class="btn-status label label-danger">Pending</span>
                                    @elseif($v->action_status == 1)
                                    <span class="btn-status label label-success">Completed</span>
                                    @else
                                    <span class="btn-status label label-info">Archived</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a class="btn btn-primary" title="Edit" href="{{route('admin.users.documents.edit',['user_id'=>$user_id,'edit'=>'edit','id'=>$v->id])}}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                    <a class="btn btn-dark delete_record" title="Delete" href="javascript:void(0);" data-id="{{$v->id}}">
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </a>
                                    @endif
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
<script src="{{URL::asset('public/js/admin/documents.js')}}"></script>
@endsection