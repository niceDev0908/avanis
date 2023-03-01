@extends('layouts.app')
@section('content')
<div id="layout-wrapper">
    @include('layouts.header')
    @include('layouts.left-sidebar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">
                                PMC Management
                            </h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">PMC Management</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class = "alert alert-danger">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @include('flash-message')
                                <form class="needs-validation" method="post" action="{{route('pmc-management-action')}}" id="pmcManagementForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <table class="table table-nowrap table-check" id="pmcManagementTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" width="13%">Type</th>
                                                    <th class="text-center" width="15%">Description</th>
                                                    <th class="text-center" width="6%">Asset In</th>
                                                    <th class="text-center" width="6%">Asset Out</th>
                                                    <th class="text-center" width="6%">Cash In</th>
                                                    <th class="text-center" width="6%">Cash Out</th>
                                                    <th class="text-center" width="7%">Trust Value Balance</th>
                                                    <th class="text-center" width="5%">Transaction Date</th>
                                                    <th class="text-center" width="11%">Doc Upload</th>
                                                    @if($pmc_data->count() > 0)<th class="text-center" width="1%">Doc Download</th>@endif
                                                    <th class="text-center" width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($pmc_data->count() > 0)
                                                    @foreach($pmc_data as $pmc)
                                                    <tr>
                                                        <input type="hidden" name="pmc_id[]" value="{{@$pmc->id}}">
                                                        <td>
                                                            <input type="text" class="form-control pmc_type" name="pmc_type" id="pmc_type" value="{{$pmc->pmc_type}}">
                                                            <input type="hidden" name="hidden_pmc_type[]" id="hidden_pmc_type">
                                                            <span class="text-danger" id="pmcTypeError" style="display:none;">Enter transaction type</span>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control pmc_description" rows="2" name="pmc_description" id="pmc_description">{{$pmc->pmc_description}}</textarea>
                                                            <input type="hidden" name="hidden_pmc_description[]" id="hidden_pmc_description">
                                                            <span class="text-danger" id="pmcDescriptionError" style="display:none;">Enter transaction description</span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control pmc_asset_in" name="pmc_asset_in" id="pmc_asset_in" value="{{$pmc->pmc_asset_in}}">
                                                            <input type="hidden" name="hidden_pmc_asset_in[]" id="hidden_pmc_asset_in">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control pmc_asset_out" name="pmc_asset_out" id="pmc_asset_out" value="{{$pmc->pmc_asset_out}}">
                                                            <input type="hidden" name="hidden_pmc_asset_out[]" id="hidden_pmc_asset_out">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control pmc_cash_in" name="pmc_cash_in" id="pmc_cash_in" value="{{$pmc->pmc_cash_in}}">
                                                            <input type="hidden" name="hidden_pmc_cash_in[]" id="hidden_pmc_cash_in">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control pmc_cash_out" name="pmc_cash_out" id="pmc_cash_out" value="{{$pmc->pmc_cash_out}}">
                                                            <input type="hidden" name="hidden_pmc_cash_out[]" id="hidden_pmc_cash_out">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control pmc_trust_val_bal" name="pmc_trust_val_bal" id="pmc_trust_val_bal" value="{{getPrice($pmc->pmc_trust_val_bal)}}" readonly>
                                                            <input type="hidden" name="hidden_pmc_trust_val_bal[]" id="hidden_pmc_trust_val_bal">
                                                        </td>
                                                        <td>
                                                            <input class="form-control pmc_date" type="date" format="yyyy-mm-dd" name="pmc_date" id="pmc_date" autocomplete="off" value="{{ $pmc->pmc_date }}">
                                                            <input type="hidden" name="hidden_pmc_date[]" id="hidden_pmc_date">
                                                            <span class="text-danger" id="pmcDateError" style="display:none;">Select date</span>
                                                        </td>
                                                        <td>
                                                            <input type="file" class="form-control pmc_file_upload" name="pmc_file_upload[]" id="pmc_file_upload" accept="image/*,.pdf,.docx,.xlsx">
                                                            <input type="hidden" value="{{$pmc->pmc_file_upload}}" name="file_value" id="file_value">
                                                            <span class="text-danger" id="pmcFileUploadError" style="display:none;">Upload file</span>  
                                                        </td>
                                                        <td class="text-center">
                                                            <a download="{{$pmc->pmc_file_upload}}"
                                                                href="{{URL::asset('public/uploads/users/'.Auth::user()->id.'/pmc_docs/'.$pmc->id.'/'.$pmc->pmc_file_upload)}}"  class="btn btn-primary waves-effect waves-light" id="pmc_download_doc">
                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="javascript:;" class="btn btn-danger waves-effect waves-light pmc_delete" id="pmc_delete">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                        <input type="hidden" value="edit" id="edit_mode">
                                                    </tr>
                                                    <input type="hidden" name="another_id[]" value="{{@$pmc->id}}">
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control pmc_type" name="pmc_type" id="pmc_type" value="">
                                                        <input type="hidden" name="hidden_pmc_type[]" id="hidden_pmc_type">
                                                        <span class="text-danger" id="pmcTypeError" style="display:none;">Enter transaction type</span>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control pmc_description" rows="2" name="pmc_description" id="pmc_description"></textarea>
                                                        <input type="hidden" name="hidden_pmc_description[]" id="hidden_pmc_description">
                                                        <span class="text-danger" id="pmcDescriptionError" style="display:none;">Enter transaction description</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control pmc_asset_in" name="pmc_asset_in" id="pmc_asset_in" value="">
                                                        <input type="hidden" name="hidden_pmc_asset_in[]" id="hidden_pmc_asset_in">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control pmc_asset_out" name="pmc_asset_out" id="pmc_asset_out" value="">
                                                        <input type="hidden" name="hidden_pmc_asset_out[]" id="hidden_pmc_asset_out">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control pmc_cash_in" name="pmc_cash_in" id="pmc_cash_in" value="">
                                                        <input type="hidden" name="hidden_pmc_cash_in[]" id="hidden_pmc_cash_in">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control pmc_cash_out" name="pmc_cash_out" id="pmc_cash_out" value="">
                                                        <input type="hidden" name="hidden_pmc_cash_out[]" id="hidden_pmc_cash_out">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control pmc_trust_val_bal" name="pmc_trust_val_bal" id="pmc_trust_val_bal" value="£0.00" readonly>
                                                        <input type="hidden" name="hidden_pmc_trust_val_bal[]" id="hidden_pmc_trust_val_bal">
                                                    </td>
                                                    <td>
                                                        <input class="form-control pmc_date" type="date" format="yyyy-mm-dd" name="pmc_date" id="pmc_date" value="">
                                                        <input type="hidden" name="hidden_pmc_date[]" id="hidden_pmc_date">
                                                        <span class="text-danger" id="pmcDateError" style="display:none;">Select date</span>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control pmc_file_upload" name="pmc_file_upload[]" id="pmc_file_upload" accept="image/*,.pdf,.docx,.xlsx">
                                                        <span class="text-danger" id="pmcFileUploadError" style="display:none;">Upload file</span>  
                                                    </td>
                                                    <!-- <td class="text-center">
                                                        <a href="javascript:;" class="btn btn-primary waves-effect waves-light" id="pmc_download_doc">
                                                            <i class="fa fa-download" aria-hidden="true"></i>
                                                        </a>
                                                    </td> -->
                                                    <td class="text-center">
                                                        <a href="javascript:;" class="btn btn-danger waves-effect waves-light pmc_delete" id="pmc_delete">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>      
                                    <div class="row mb-3">
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" id="add_more_pmc">
                                                <i class="mdi mdi-plus"></i>
                                            </button>
                                        </div>
                                    </div>  
                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" id="savePMCBtn">Save</button>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    </div>
</div>
<table style="display:none;" id="hiddenPMCTable">
    <tr>
        <td>
            <input type="text" class="form-control pmc_type" name="pmc_type" id="pmc_type" value="">
            <input type="hidden" name="hidden_pmc_type[]" id="hidden_pmc_type">
            <span class="text-danger" id="pmcTypeError" style="display:none;">Enter transaction type</span>
        </td>
        <td>
            <textarea class="form-control pmc_description" rows="2" name="pmc_description" id="pmc_description"></textarea>
            <input type="hidden" name="hidden_pmc_description[]" id="hidden_pmc_description">
            <span class="text-danger" id="pmcDescriptionError" style="display:none;">Enter transaction description</span>
        </td>
        <td>
            <input type="text" class="form-control pmc_asset_in" name="pmc_asset_in" id="pmc_asset_in" value="">
            <input type="hidden" name="hidden_pmc_asset_in[]" id="pmc_asset_in">
        </td>
        <td>
            <input type="text" class="form-control pmc_asset_out" name="pmc_asset_out" id="pmc_asset_out" value="">
            <input type="hidden" name="hidden_pmc_asset_out[]" id="pmc_asset_out">
        </td>
        <td>
            <input type="text" class="form-control pmc_cash_in" name="pmc_cash_in" id="pmc_cash_in" value="">
            <input type="hidden" name="hidden_pmc_cash_in[]" id="pmc_cash_in">
        </td>
        <td>
            <input type="text" class="form-control pmc_cash_out" name="pmc_cash_out" id="pmc_cash_out" value="">
            <input type="hidden" name="hidden_pmc_cash_out[]" id="pmc_cash_out">
        </td>
        <td>
            <input type="text" class="form-control pmc_trust_val_bal" name="pmc_trust_val_bal" id="pmc_trust_val_bal" value="" readonly>
            <input type="hidden" name="hidden_pmc_trust_val_bal[]" id="pmc_trust_val_bal">
        </td>
        <td>
            <input class="form-control pmc_date" type="date" format="yyyy-mm-dd" name="pmc_date" id="pmc_date" value="">
            <input type="hidden" name="hidden_pmc_date[]" id="hidden_pmc_date">
            <span class="text-danger" id="pmcDateError" style="display:none;">Select date</span>
        </td>
        <td>
            <input type="file" class="form-control pmc_file_upload" name="pmc_file_upload[]" id="pmc_file_upload" accept="image/*,.pdf,.docx,.xlsx">
            <span class="text-danger" id="pmcFileUploadError" style="display:none;">Upload file</span>  
        </td>
        <!-- <td class="text-center">
            <a href="javascript:;" class="btn btn-primary waves-effect waves-light" id="pmc_download_doc">
                <i class="fa fa-download" aria-hidden="true"></i>
            </a>
        </td> -->
        <td class="text-center">
            <a href="javascript:;" class="btn btn-danger waves-effect waves-light pmc_delete" id="pmc_delete">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
</table>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/front/pmc-management.js')}}"></script>
@endsection