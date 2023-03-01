@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{URL::asset('public/assets/libs/magnific-popup.css')}}"/> 
<link href="{{ URL::asset('public/css/custom.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                                Assets
                            </h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">Assets</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="success-msg"></div>
                                <form class="needs-validation" method="post" action="javascript:void(0);" id="manageAssetForm" enctype="multipart/form-data">
                                    @csrf
                                    @if (count($data) > 0)
                                        @foreach($data as $asset)
                                        <div class="row mb-3 add_more align-items-baseline" id="assetRow_{{$asset->id}}">
                                            <input type="hidden" name="assetID" value="{{$asset->id}}">
                                            <div class="col-md-2">
                                                <label for="" class="form-label">Type of Cryptocurrency</label>
                                                <input type="text" class="form-control description" name="description" 
                                                value="{{$asset->description}}" id="description_{{$asset->id}}" data-olddescription="{{$asset->description}}">
                                            </div>
                                            <div class="col-md-1">
                                                <label for="" class="form-label">Quantity Held</label>
                                                <input type="text" class="form-control assetvalue" name="value" id="assetvalue_{{$asset->id}}"
                                                value="{{$asset->value}}" data-oldassetvalue="{{$asset->value}}"> 
                                            </div>
                                            <div class="col-md-1">
                                                <label for="" class="form-label">Currency</label>
                                                <select class="form-select currency" name="currency" id="currency_{{$asset->id}}" data-oldcurrency="{{$asset->currency}}">
                                                    <option disabled selected>Select Currency</option>
                                                    <option value="dollar" {{$asset->currency === 'dollar' ? 'selected' : ''}}>$ Dollar</option>
                                                    <option value="pound" {{$asset->currency === 'pound' ? 'selected' : ''}}>£ Pound</option>
                                                    <option value="euro" {{$asset->currency === 'euro' ? 'selected' : ''}}>€ Euro</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="form-label">Current Price Per Unit</label>
                                                <input type="text" class="form-control currentPricePerUnit" name="current_price_per_unit" 
                                                id="currentPricePerUnit_{{$asset->id}}" value="{{$asset->current_price_per_unit}}" 
                                                data-oldCurrentPricePerUnit="{{$asset->current_price_per_unit}}"> 
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="form-label">Total Value of Holdings</label>
                                                <input type="text" class="form-control totalValueOfHolding" name="total_value_of_holding" 
                                                id="totalValueOfHolding_{{$asset->id}}" value="{{$asset->total_value_of_holding}}"
                                                data-oldTotalValueOfHolding="{{$asset->total_value_of_holding}}"> 
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="form-label">Last Updated</label>
                                                <input type="text" class="form-control last_updated_date" name="last_updated_date" id="last_updated_date" 
                                                value="{{getFormatedDate($asset->updated_at)}}" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="main-btn-section">
                                                    <label for="file-upload" class="download-label" style="border: 1px solid #556ee6;display: inline-block;padding: 6px 12px;cursor: pointer;color: #fff;background-color: #556ee6;border-color: #556ee6;">
                                                        <i class="fa fa-upload"></i></a>
                                                    </label>
                                                    <input id="file-upload" name="asset_file" class="asset_file" type="file" style="display:none;"
                                                    data-oldAssetFileValue="{{$asset->asset_file}}" />
                                                    @if($asset->asset_file)
                                                    <a href="{{URL::asset('public/uploads/user_assets/'.$asset->id.'/'.$asset->asset_file)}}"  
                                                        class="btn btn-primary waves-effect waves-light download-label image-link view_asset_image" 
                                                        style="top: 25px;left: 4px;margin-right: 6px;" id="asset_image_{{$asset->id}}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
                                                    <button class="btn btn-primary waves-effect waves-light asset-btn" id="updateBtn" type="submit"
                                                        data-id="{{$asset->id}}">
                                                        Update
                                                    </button>
                                                    <a href="javascript:;" class="btn btn-danger waves-effect waves-light close_asset_field" 
                                                        data-delete="{{$asset->id}}" id="deleteAsset" style="top: 25px;left: 4px;">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="row mb-3 add_more align-items-baseline">
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Type of Cryptocurrency</label>
                                            <input type="text" class="form-control description" name="description" id="description">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="" class="form-label">Quantity Held</label>
                                            <input type="text" class="form-control assetvalue" name="value" id="assetvalue">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="" class="form-label">Currency</label>
                                            <select class="form-select currency" name="currency" id="currency">
                                                <option disabled selected>Select Currency</option>
                                                <option value="dollar">$ Dollar</option>
                                                <option value="pound">£ Pound</option>
                                                <option value="euro">€ Euro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Current Price Per Unit</label>
                                            <input type="text" class="form-control currentPricePerUnit" name="current_price_per_unit" 
                                            id="currentPricePerUnit"> 
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Total Value of Holdings</label>
                                            <input type="text" class="form-control totalValueOfHolding" name="total_value_of_holding" 
                                            id="totalValueOfHolding"> 
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Last Updated</label>
                                            <input type="text" class="form-control last_updated_date" name="last_updated_date" id="last_updated_date" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="main-btn-section">
                                                <label for="file-upload" class="download-label" style="border: 1px solid #556ee6;display: inline-block;padding: 6px 12px;cursor: pointer;color: #fff;background-color: #556ee6;border-color: #556ee6;">
                                                    <i class="fa fa-upload"></i></a>
                                                </label>
                                                <input id="file-upload" name="asset_file" type="file" style="display:none;"/>
                                                <a href="" class="btn btn-primary waves-effect waves-light download-label image-link view_asset_image" id="asset_image" style="top: 25px;left: 4px;display:none;margin-right: 6px;">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <button class="btn btn-primary waves-effect waves-light asset-btn" id="updateBtn" type="submit">Update</button>
                                                <a href="javascript:;" class="btn btn-danger waves-effect waves-light close_asset_field" style="top: 25px;left: 4px;">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="result">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" id="add_more">
                                                <i class="mdi mdi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <input type="checkbox" id="send_notification" name="send_notification">
                                            <label for="send_notify"> Check and submit the details when you have added all the details.</label>
                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="send_notification_btn">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/assets/libs/jquery.magnific-popup.js')}}"></script>
<script src="{{URL::asset('public/js/front/assets.js')}}"></script>
@endsection