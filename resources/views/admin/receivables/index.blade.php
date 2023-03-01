@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Transactions</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Transactions</li>
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
                                <th width="33%" class="text-center">User</th>
                                <th width="10%" class="text-center">User Type</th>
                                <th width="33%" class="text-center">Date</th>
                                <th width="13%" class="text-center">Amount</th>
                                @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                <th width="10%" style="text-align: center;">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($receivables) > 0)
                            @foreach ($receivables as $key => $v)
                            <tr id="row_{{$v->id}}">
                                <td>{{ @$v->user['first_name']}} {{ @$v->user['last_name']}}</td>
                                <td>{{ @$v->user['product_type'] }}</td>
                                <td class="text-center">{{ getFormatedDate($v->date) }}</td>
                                <td class="text-center">{{ getPrice($v->amount) }}</td>
                                @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                <td style="text-align: center;">
                                    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                    <a class="btn btn-primary" title="Edit" href="{{route('admin.receivables_recipients.view',$v->id)}}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-dark delete_record" title="Delete" href="{{route('admin.receivables.delete', $v->id)}}">
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="4">No transactions available</td>
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
<script src="{{URL::asset('public/js/admin/receivables.js')}}"></script>
@endsection