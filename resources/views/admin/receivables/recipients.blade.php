@extends('admin.layouts.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Transaction Recipients</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.receivables')}}">Receivables</a></li>
                <li class="breadcrumb-item active">Recipients</li>
            </ol>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form name="frmCreateEditRecipient" id="frmCreateEditRecipient" method="post" action="{{ route('admin.receivable.recipients.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Receivable</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    {{$data->user->first_name}} {{$data->user->last_name}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Amount</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    £ {{$data->amount}}
                                </div>
                            </div>
                        </div>
                        <br /><br />
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <label class="control-label">Recipient Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <label class="control-label">Planning Fee (%)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <label class="control-label">&nbsp;</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <label class="control-label total_planning_fee" data-val="{{($data->amount * $data->planning_fee) / 100}}">£ {{($data->amount * $data->planning_fee) / 100}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <label class="control-label total_avanis_fee" data-val="{{($data->amount * $data->avanis_fee) / 100}}">£ {{($data->amount * $data->avanis_fee) / 100}}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <label class="control-label">&nbsp;</label>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="original_recipient" style="display: none;">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="recipient_name[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="planning_fee[]" id="planning_fee_per_" data-recipient-no="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <span class="planning_fee_amount_total"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="avanis_fee[]" id="avanis_fee_per_" data-recipient-no="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <span class="avanis_fee_amount_total"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a class="btn btn-danger delete-recipient" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>

                        @foreach($user_recipients as $key => $val)
                        <?php
                        $recipient_no = $key+1;
                        ?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="recipient_name[]" class="form-control" value="{{$val->recipient_name}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="planning_fee[]" id="planning_fee_per_{{$recipient_no}}" data-recipient-no="{{$recipient_no}}" class="form-control" value="{{$val->planning_fee}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                    $amount = ($data->amount * $data->planning_fee) / 100;
                                    $amount = ($amount * $val->planning_fee) / 100;
                                    ?>
                                    <span class="planning_fee_amount_total" id="planning_fee_amount_{{$recipient_no}}" data-recipient-no="{{$recipient_no}}" data-val="{{$amount}}">£ {{$amount}}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="avanis_fee[]" id="avanis_fee_per_{{$recipient_no}}" data-recipient-no="{{$recipient_no}}" class="form-control" value="{{$val->avanis_fee}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                    $amount = ($data->amount * $data->avanis_fee) / 100;
                                    $amount = ($amount * $val->avanis_fee) / 100;
                                    ?>
                                    <span class="avanis_fee_amount_total" id="avanis_fee_amount_{{$recipient_no}}" data-recipient-no="{{$recipient_no}}" data-val="{{$amount}}">£ {{$amount}}</span>
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
                            <div class="col-md-2">
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
                                <div class="form-group">
                                    <label class="control-label" id="planning_fee_amount_total"></label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <label class="control-label" id="avanis_fee_total"></label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" id="avanis_fee_amount_total"></label>
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
                            <a class="btn btn-dark" href="{{ route('admin.receivables') }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/receivable_recipients.js')}}"></script>
@endsection