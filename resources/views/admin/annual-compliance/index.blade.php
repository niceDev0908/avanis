@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Annual Compliance</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Annual Compliance</li>
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
                                <th width="25%" class="text-center">User</th>
                                <th width="25%" class="text-center">Submitted Date</th>
                                <th width="25%" class="text-center">Approved Date</th>
                                <th width="25%" class="text-center">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($annual_compliance) > 0)
                            @foreach ($annual_compliance as $key => $v)
                            <?php 
                                if($v->user){
                                    $name = $v->user['first_name'].' '.$v->user['last_name'];
                                }else{
                                    $name = '';
                                }
                            ?>
                            <tr id="row_{{$v->id}}">
                                <td>{{ $v->user ? $name : ''}}</td>
                                <td class="text-center">{{ getFormatedDateTime($v->updated_at) }}</td>
                                <td class="text-center">{{ getFormatedDate($v->approved_date) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.annual-compliance.view', $v->user_id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="4">No compliance details available</td>
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
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "aaSorting": [],
            'columnDefs': [{
                    //'targets': [0, 5],
                    'orderable': false,
                }]
        });
    });
</script>
@endsection