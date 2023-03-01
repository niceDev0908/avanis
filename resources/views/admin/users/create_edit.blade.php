@extends('admin.layouts.app')
@section('style')
<link rel="stylesheet" href="{{URL::asset('public/assets/libs/magnific-popup.css')}}"/> 
@endsection
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ $data->id > 0 ? 'Edit' : 'Add' }} User</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Users</a></li>
                <li class="breadcrumb-item active">
                    {{ $data->id > 0 ? 'Edit' : 'Add' }} User
                </li>
            </ol>
            <a class="btn btn-dark d-none d-lg-block m-l-15" href="{{ route('admin.users') }}">Back</a>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#manage-profile">Manage User Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#manage-recipient">Manage Recipient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#manage-assets">Manage Assets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#manage-pmc">Manage PMC</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="manage-profile" class="container tab-pane active"><br>
                        <form name="frmCreateEdit" id="frmCreateEdit" method="post" action="{{ route('admin.users.store') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$data->id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" name="f_name" id="f_name" class="form-control" value="{{$data->first_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" name="l_name" id="l_name" class="form-control" value="{{$data->last_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{$data->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Company</label>
                                            <input type="text" name="company" id="company" class="form-control" value="{{$data->company}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" name="c_password" id="c_password" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{$data->phone_number}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address 1</label>
                                            <input type="text" name="address" id="address" class="form-control" value="{{$data->address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address 2</label>
                                            <input type="text" name="address2" id="address2" class="form-control" value="{{$data->address2}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Town</label>
                                            <input type="text" name="town" id="town" class="form-control" value="{{$data->town}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">County</label>
                                            <input type="text" name="county" id="county" class="form-control" value="{{$data->county}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Country</label>
                                            <select class="form-control custom-select" name="country" id="country">
                                                <option value="United Kingdom" selected>United Kingdom</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Post Code</label>
                                            <input type="text" name="postcode" id="postcode" class="form-control" value="{{$data->postcode}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            {!! Form::select('roles', $roles, $userRole, ['class' => 'form-control custom-select','id'=> 'select-role']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Application Code</label>
                                            <input type="text" name="intermediary_code" id="intermediary_code" class="form-control" value="{{$data->intermediary_code}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Allows Application Code</label>
                                            <input type="text" name="allows_intermediary_code" id="allows_intermediary_code" class="form-control" value="{{$data->allows_intermediary_code}}">
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Avanis Fee (%)</label>
                                            <input type="text" name="avanis_fee" id="avanis_fee" class="form-control" value="{{$data->avanis_fee}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Planning Fee (%)</label>
                                            <input type="text" name="planning_fee" id="planning_fee" class="form-control" value="{{$data->planning_fee}}">
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Onboarding Date</label>
                                            <input type="date" name="date_of_rsa" id="date_of_rsa" class="form-control" value="{{$data->date_of_rsa}}">
                                        </div>
                                    </div>
<!--                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Date of FSA</label>
                                            <input type="date" name="date_of_fsa" id="date_of_fsa" class="form-control" value="{{$data->date_of_fsa}}">
                                        </div>
                                    </div>-->
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Show Transactions</label>
                                            <select class="form-control custom-select" name="receivables" id="receivables">
                                                <option value="" {{ $data->receivables === '' ? 'selected' : '' }}>Select Show Transactions</option>
                                                <option value="1" {{ $data->receivables === 1 ? 'selected' : '' }}>Show</option>
                                                <option value="0" {{ $data->receivables === 0 ? 'selected' : '' }}>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product Type</label>
                                            <input type="text" name="product_type" id="product_type" class="form-control" value="{{$data->product_type}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label">Notes</label>
                                        <textarea class="form-control" name="user_notes" id="user_notes" rows="15" cols="10">{{$data->user_notes}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Business Type</label>
                                            <select class="form-control custom-select" name="business_type" id="business_type">
                                                <option value="" {{$data->business_type == '' ? 'selected' : ''}}>Select Business Type</option>
                                                <option value="Sole Trader" {{$data->business_type == 'Sole Trader' ? 'selected' : ''}}>Sole Trader</option>
                                                <option value="Partnership" {{$data->business_type == 'Partnership' ? 'selected' : ''}}>Partnership</option>
                                                <option value="Company" {{$data->business_type == 'Company' ? 'selected' : ''}}>Company</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control custom-select" name="status" id="status" {{ Auth::user()->id == $data->id ? 'disabled' : '' }}>
                                                    <option value="" {{ $data->status === '' ? 'selected' : '' }}>Select Status</option>
                                                <option value="1" {{ $data->status === 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $data->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                <option value="2" {{ $data->status === 2 ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="old_status" value="{{$data->status}}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                                    <a class="btn btn-dark" href="{{ route('admin.users') }}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="manage-recipient" class="container tab-pane fade"><br>
                        <form name="frmCreateEditRecipient" id="frmCreateEditRecipient" method="post" action="{{ route('admin.recipients.store') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$data->id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group text-center">
                                            <label class="control-label">Recipient Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center">
                                            <label class="control-label">Planning Fee (%)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center">
                                            <label class="control-label">Avanis Fee (%)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center">
                                            <label class="control-label">&nbsp;</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" id="original_recipient" style="display: none;">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="recipient_name[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="planning_fee[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="avanis_fee[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <a class="btn btn-danger delete-recipient" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                
                                @foreach($user_recipients as $key => $val)
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="recipient_name[]" class="form-control" value="{{$val->recipient_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="planning_fee[]" class="form-control" value="{{$val->planning_fee}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="avanis_fee[]" class="form-control" value="{{$val->avanis_fee}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <a class="btn btn-danger delete-recipient" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div id="insert_before"></div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group text-center">
                                            <label class="control-label">Total</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center">
                                            <label class="control-label" id="planning_fee_total"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center">
                                            <label class="control-label" id="avanis_fee_total"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center">
                                            <label class="control-label">&nbsp;</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <a class="btn btn-dark" href="javascript:void(0);" id="add_recipient">Add Recipient</a>
                                </div>
                                <br /><br />
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                                    <a class="btn btn-dark" href="{{ route('admin.users') }}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="manage-assets" class="container tab-pane fade"><br>
                        <div class="table-responsive">
                            <table id="assetTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="10%">Type of Cryptocurrency</th>
                                        <th width="10%">Quantity Held</th>
                                        <th width="15%">Currency</th>
                                        <th width="10%">Current Price Per Unit</th>
                                        <th width="5%">Total Value of Holdings</th>
                                        <th width="5%"></th>
                                        <th width="15%">Last Updated</th>
                                        <th width="10%" style="text-align: center;">View Log</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($user_assets as $asset => $v)
                                            <?php 
                                                $currency = $v->currency;
                                                if($currency == 'pound'){
                                                    $currency_value = 'Pound £';
                                                }else if($currency == 'dollar') {
                                                    $currency_value = 'Dollar $';
                                                }else if($currency == 'euro') {
                                                    $currency_value = 'Euro €';
                                                }
                                            ?>
                                            <tr id="row_{{$v->id}}" class=" {{$v->deleted_at ? 'table-danger' : '' }} ">
                                                <td>{{$v->description}}</td>
                                                <td>{{$v->value}}</td>
                                                <td>{{$currency_value}}</td>
                                                <td>{{$v->current_price_per_unit ? $v->current_price_per_unit : ''}}</td>
                                                <td>{{$v->total_value_of_holding ? $v->total_value_of_holding : ''}}</td>
                                                <td>
                                                    @if($v->deleted_at == null)
                                                    <a href="{{URL::asset('public/uploads/user_assets/'.$v->id.'/'.$v->asset_file)}}" 
                                                        class="btn btn-dark image-link">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>    
                                                    </a>
                                                    @endif
                                                </td>
                                                <td>{{getFormatedDate($v->updated_at)}}</td>
                                                <td style="text-align: center;">
                                                    <a href="javascript:;" id="userAssetLog" data-attr="{{ route('admin.users.asset-log', $v->id) }}" data-toggle="modal" data-target="#viewAssetLogModal" class="btn btn-dark" title="View Log">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>    
                                                    </a>                  
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="manage-pmc" class="container tab-pane fade"><br>
                        <div class="table-responsive">
                            <table id="pmcDataTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th colspan="2" class="text-center">Asset Transactions</th>
                                        <th colspan="2" class="text-center">Cash Transactions</th>
                                        <th colspan="3"></th>
                                    </tr>
                                    <tr>
                                        <th width="20%">PMC Type</th>
                                        <th width="20%">PMC Description</th>
                                        <th width="10%">Asset In</th>
                                        <th width="10%">Asset Out</th>
                                        <th width="10%">Cash In</th>
                                        <th width="10%">Cash Out</th>
                                        <th width="8%">Trust Value Balance</th>
                                        <th width="12%">Transaction Date</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_pmc as $pmc)
                                    <tr>
                                        <td>{{$pmc->pmc_type}}</td>
                                        <td>{{$pmc->pmc_description}}</td>
                                        <td>{{getPrice($pmc->pmc_asset_in)}}</td>
                                        <td>{{getPrice($pmc->pmc_asset_out)}}</td>
                                        <td>{{getPrice($pmc->pmc_cash_in)}}</td>
                                        <td>{{getPrice($pmc->pmc_cash_out)}}</td>
                                        <td>{{getPrice($pmc->pmc_trust_val_bal)}}</td>
                                        <td>{{$pmc->pmc_date ? getFormatedDate($pmc->pmc_date) : ''}}</td>
                                        <td>
                                            <a download="{{$pmc->pmc_file_upload}}" href="{{URL::asset('public/uploads/users/'.$pmc->user_id.'/pmc_docs/'.$pmc->id.'/'.$pmc->pmc_file_upload)}}" class="btn btn-dark" title="Download Document">
                                                <i class="fas fa-download" aria-hidden="true"></i>    
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
    </div>
</div>
<div id="viewAssetLogModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">View Asset Log</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="viewAssetLogBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/assets/libs/jquery.magnific-popup.js')}}"></script>
<script src="{{URL::asset('public/js/admin/user.js')}}"></script>
@endsection