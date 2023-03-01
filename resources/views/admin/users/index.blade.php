@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Users</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
            @can('role-create')
            <a class="btn btn-primary d-none d-lg-block m-l-15" href="{{route('admin.users.create')}}"><i class="fa fa-plus-circle"></i> Add User</a>
            @endcan
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
                                <th width="10%">Name</th>
                                <th width="10%">Company</th>
                                <th width="15%">Email</th>
                                <th width="10%">Username</th>
                                <th width="10%" style="text-align: center;">Application Code</th>
                                <th width="10%" style="text-align: center;">Role</th>
                                <th width="10%" style="text-align: center;">Type</th>
                                <th width="10%" style="text-align: center;">Status</th>
                                <th width="10%" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data) > 0)
                            @foreach ($data as $key => $v)
                            <tr id="row_{{$v->id}}">
                                @if(Auth::user()->id != $v->id)
                                    <td style="text-align: center;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input cb-element" name="chk{{$v->id}}" id="chk{{$v->id}}" value="{{$v->id}}" aria-invalid="false">
                                            <label class="custom-control-label" for="chk{{$v->id}}"></label>
                                        </div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $v->first_name}} {{ $v->last_name}}</td>
                                <td>{{ $v->company}}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->username }}</td>
                                <td style="text-align: center;">{{ $v->intermediary_code }}</td>
                                <td style="text-align: center;">
                                    @if(!empty($v->getRoleNames()))
                                        @foreach($v->getRoleNames() as $v1)
                                            {{ $v1 }}
                                        @endforeach
                                    @endif
                                </td>
                                <td style="text-align: center;">{{ $v->product_type }}</td>
                                <td style="text-align: center;">
                                    @if($v->status == 1)
                                    <span class="btn-status label label-success">Active</span>
                                    @elseif($v->status == 2)
                                    <span class="btn-status label label-danger">Pending</span>
                                    @elseif($v->status == 0)
                                    <span class="btn-status label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                    <a class="btn btn-primary" style="margin-bottom: 5px;" title="Edit" href="{{route('admin.users.edit',$v->id)}}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                    @if(Auth::user()->id != $v->id)
                                        @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                        <a class="btn btn-dark delete_record" style="margin-bottom: 5px;" title="Delete" href="{{route('admin.users.delete', $v->id)}}">
                                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                        <a class="btn btn-primary" title="Action" href="{{route('admin.users.documents',$v->id)}}">
                                            <i class="fas fa-tasks" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('admin.users.messages',$v->id)}}" class="btn btn-dark" title="Send Message">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>    
                                        </a>
                                        <?php 
                                            $path = public_path('uploads/users/'.$v->id);
                                        ?>
                                        @if(File::isDirectory($path))
                                        <a href="{{route('admin.users.download-documents',$v->id)}}" class="btn btn-dark" title="Download Documents">
                                            <i class="fas fa-download" aria-hidden="true"></i>    
                                        </a>
                                        @endif
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="8">No client data available</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ URL::asset('public/assets/libs/croppie/croppie.min.js') }}"></script>
<script src="{{URL::asset('public/js/admin/user.js')}}"></script>
@endsection