@extends('admin.layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ $data->id > 0 ? 'Edit' : 'Add' }} User Action ({{ $user_data->first_name }} {{ $user_data->last_name }})</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.users.documents', [$user_data->id])}}">User Actions</a></li>
                <li class="breadcrumb-item active">
                    {{ $data->id > 0 ? 'Edit' : 'Add' }} User Action
                </li>
            </ol>
            <a class="btn btn-dark d-none d-lg-block m-l-15" href="{{route('admin.users.documents', [$user_data->id])}}">Back</a>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form name="frmCreateEdit" id="frmCreateEdit" method="post" action="{{ route('admin.users.documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <div class="form-body">
                        @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox mr-sm-2 mb-3">
                                        <input type="checkbox" class="custom-control-input" name="is_request_document" id="is_request_document" value="1" @if($data->is_request_document == 1) checked="checked" @endif @if($data->id >0) disabled="disabled" @endif >
                                               <label class="custom-control-label" for="is_request_document">Is Request Document?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Receivable</label>
                                    <select class="form-control custom-select" name="receivable_id" id="receivable_id">
                                        <option value="">Select Receivable</option>
                                        <option value="0" {{ $data->receivable_id === 0 ? 'selected' : '' }}>Other</option>
                                        @foreach($receivables as $rec_key => $rec_val)
                                        <option value="{{$rec_val->id}}" {{ $rec_val->id === $data->receivable_id ? 'selected' : '' }}>£ {{$rec_val->amount}} - {{getFormatedDate($rec_val->date)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Action Title</label>
                                    <!-- <input type="text" name="title" id="title" class="form-control" value="{{$data->title}}"> -->
                                    <select class="form-control custom-select" name="title" id="title">
                                        <option value="">Select Action Title</option>
                                        <option value="Sign Notice of Transfer Document" {{$data->title === "Sign Notice of Transfer Document" ? "selected" : ''}}>
                                            Sign Notice of Transfer Document
                                        </option>
                                        <option value="Transaction Confirmation (Transfer to PMC)" {{$data->title === "Transaction Confirmation (Transfer to PMC)" ? "selected" : ''}}>
                                            Transaction Confirmation (Transfer to PMC)
                                        </option>
                                        <option value="Transaction Confirmation (Payment of Fees)" {{$data->title === "Transaction Confirmation (Payment of Fees)" ? "selected" : ''}}>
                                            Transaction Confirmation (Payment of Fees)
                                        </option>
                                        <option value="Client Onboarding Document" {{$data->title === "Client Onboarding Document" ? "selected" : ''}}>
                                            Client Onboarding Document
                                        </option>
                                        <option value="Completed Onboarding Document" {{$data->title === "Completed Onboarding Document" ? "selected" : ''}}>
                                            Completed Onboarding Document
                                        </option>
                                        <option value="Sign Document" {{$data->title === "Sign Document" ? "selected" : ''}}>
                                            Sign Document
                                        </option>
                                        <option value="Asset Information" {{$data->title === "Asset Information" ? "selected" : ''}}>
                                            Asset Information
                                        </option>
                                        <option value="Transaction Confirmation (Joining Fees)" {{$data->title === "Transaction Confirmation (Joining Fees)" ? "selected" : ''}}>
                                            Transaction Confirmation (Joining Fees)
                                        </option>
                                        <option value="Transaction Confirmation (Transfer Fees)" {{$data->title === "Transaction Confirmation (Transfer Fees)" ? "selected" : ''}}>
                                            Transaction Confirmation (Transfer Fees)
                                        </option>
                                        <option value="Trustee Assignment Issued" {{$data->title === "Trustee Assignment Issued" ? "selected" : ''}}>
                                            Trustee Assignment Issued
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row add_more" id="add_more">
                            <!--<div class="col-md-3">
                                <label class="control-label">Upload Reference</label>
                                <input type="file" name="upload_action_docs[]" id="upload_ref" class="form-control" value="" accept = "">                                 
                            </div>-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Document Title</label>
                                    <!-- <input type="text" name="document_title[]" id="document_title" class="form-control" value=""> -->
                                    <select class="form-control custom-select" name="document_title[]" id="document_title">
                                        <option value="">Select Document Title</option>
                                        <option value="Notice of Transfer of Receivables">Notice of Transfer of Receivables</option>
                                        <option value="Notice of Transfer to PMC">Notice of Transfer to PMC</option>
                                        <option value="Revenue Services Agreement">Revenue Services Agreement</option>
                                        <option value="Revenue Services Undertaking">Revenue Services Undertaking</option>
                                        <option value="Fiduciary Services Agreement">Fiduciary Services Agreement</option>
                                        <option value="Proof of Payment">Proof of Payment</option>
                                        <option value="Fiduciary Declaration">Fiduciary Declaration</option>
                                        <option value="Engagement Letter">Engagement Letter</option>
                                        <option value="Schedule of Assets">Schedule of Assets</option>
                                        <option value="Business Transfer Agreement">Business Transfer Agreement</option>
                                        <option value="Trustee Assignment Deed">Trustee Assignment Deed</option>
                                        <option value="Proof of Ownership">Proof of Ownership</option>
                                        <option value="Proof of Asset Ownership">Proof of Asset Ownership</option>
                                        <option value="Proof of Crypto Ownership">Proof of Crypto Ownership</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 document_url">
                                <label class="control-label">Document URL</label>
                                <input type="text" name="document_url[]" id="document_url" class="form-control">                                 
                            </div>
                            <span class="dynamic-add-form-close" id="dynamicAddForm2_remove_current remove-btn" style="display: none;color: red">
                                <i aria-hidden="true" class="fa fa-times"></i>
                            </span>  
                        </div>
                        <div class="results" id="result"></div>
                        <a href="javascript:;" class="btn btn-primary" id="add_more_btn"><i class="icons-Add-File"></i><span> Add Document</span></a><br><br>
                        @endif
                        @if($data->is_request_document == 0)
                        @if($data->user_action_documents->count() > 0)
                        <div class="row mb-3">
                            <div class="col-md-12">&nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="20%">Document Title</th>
                                                <th style="width: 10%; text-align: center;">Document URL</th>
                                                <th style="width: 30%; text-align: center;">Signed Document</th>
                                                <th style="width: 10%; text-align: center;">Signed Status</th>
                                                <th style="width: 10%; text-align: center;">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data->user_action_documents as $action)
                                            <tr id="action_doc_{{$action->id}}">
                                                <td>{{$action->document_title}}</td>
                                                <td style="text-align: center;">
                                                    <a href="{{$action->document_url}}" target="_blank">
                                                        View Document
                                                    </a>
                                                </td>
                                                <td style="text-align: center;">
                                                    @if($action->is_signed == 0)
                                                    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                                    <input type="file" name="signed_document[<?php echo $action->id; ?>]" />
                                                    @endif
                                                    @elseif($action->is_signed == 1)
                                                    <a class=" btn btn-primary" href="{{URL::to('/')}}/public/uploads/users/{{$data->user_id}}/actions/{{$action->user_action_id . '/' . $action->document_name}}" target="_blank"> View</a>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    @if($action->is_signed == 0)
                                                    Pending
                                                    @elseif($action->is_signed == 1)
                                                    Complete
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                                                    <a class="btn btn-dark delete_doc" title="Delete" href="javascript:void(0);" data-id="{{$action->id}}">
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
                        @else
                        <div class="alert alert-info alert-dismissible fade show mb-5" role="alert">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            There are no documents
                        </div>
                        @endif
                        @else
                        <hr />
                        @foreach($requested_documents as $key => $value)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h4><b>{{$value->document_title}}</b></h4>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <input type="file" name="requested_document[<?php echo $value->id; ?>]" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($value->user_action_required_document as $key_doc => $value_doc)
                            <div class="col-md-2">
                                <div style="min-height: 132px; text-align: center;">
                                    @if(substr($value_doc->document_name, -3) == "pdf")
                                    <img class="card-img-top img-fluid" src="{{ URL::asset('public/images/pdf.png') }}" style="width: 64px; height: auto;">
                                    @elseif(substr($value_doc->document_name, -4) == "docx" || substr($value_doc->document_name, -3) == "doc")
                                    <img class="card-img-top img-fluid" src="{{ URL::asset('public/images/word.png') }}" style="width: 64px; height: auto;">
                                    @else
                                    <img class="card-img-top img-fluid" src="{{ URL::asset('public/uploads/users/' . $user_id . '/actions/' . $value->user_action_id . '/' . $value->id . '/' . $value_doc->document_name) }}" style="max-width: 200px; height: auto;">
                                    @endif
                                </div>
                                <div class="pt-3 text-center" style="color: black;">
                                    @php
                                    $file_name = explode("_", $value_doc->document_name);
                                    unset($file_name[0]);
                                    $file_name = implode("_", $file_name);
                                    @endphp
                                    <a href="javascript:void(0);" data-file-name="{{$file_name}}" data-url="{{ URL::asset('public/uploads/users/' . $user_id . '/actions/' . $value->user_action_id . '/' . $value->id . '/' . $value_doc->document_name) }}" class="fw-medium download-file"><b>Download</b></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <hr />
                        @endforeach
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-12">&nbsp;
                            </div>
                        </div>

                        @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Action Status</label>
                                    <select class="form-control custom-select" name="action_status" id="action_status">
                                        <option value="" {{ $data->action_status === '' ? 'selected' : '' }}>Select Status</option>
                                        <option value="0" {{ $data->action_status === 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ $data->action_status === 1 ? 'selected' : '' }}>Completed</option>
                                        <option value="2" {{ $data->action_status === 2 ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-actions">
                            @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                            @endif
                            <a class="btn btn-dark" href="{{ route('admin.users.documents',$user_id) }}">Cancel</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/documents.js')}}"></script>
@endsection