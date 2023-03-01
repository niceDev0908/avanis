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
                                @if(Auth::user()->product_type == 'CFP')
                                CFP Transaction Notes
                                @else
                                Receivables
                                @endif
                            </h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">
                                        @if(Auth::user()->product_type == 'CFP')
                                        CFP Transaction Notes
                                        @else
                                        Receivables
                                        @endif
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @include('flash-message')
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        @if(Auth::user()->receivables == 1)
                                        <div class="text-sm-end">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".factor_receivables"><i class="mdi mdi-plus me-1"></i>
                                                @if(Auth::user()->product_type == 'CFP')
                                                CFP Transaction
                                                @else
                                                Factor Receivable
                                                @endif
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-check">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="10%" class="text-center">
                                                    @if(Auth::user()->product_type == 'CFP')
                                                    Deposit No.
                                                    @else
                                                    Receivable No.
                                                    @endif
                                                </th>
                                                <th width="20%" class="align-middle">Date</th>
                                                <th width="70%" class="align-middle">Amount</th>
<!--                                                <th class="align-middle">Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($receivables->count() > 0)
                                            @php
                                            $counter = 0
                                            @endphp
                                            @foreach($receivables as $receivable)
                                            @php
                                            $counter++
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{$counter}}</td>
                                                <td>{{getFormatedDate($receivable->date)}}</td>
                                                <td>{{getPrice($receivable->amount)}}</td>
<!--                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                    </div>
                                                </td>-->
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="3">
                                                    <div class="alert alert-info alert-dismissible fade show mb-0 text-center" role="alert">
                                                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                                                        There are no
                                                        @if(Auth::user()->product_type == 'CFP')
                                                        deposits
                                                        @else
                                                        receivables
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade factor_receivables" tabindex="-1" role="dialog" aria-labelledby=factor_receivablesLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id=factor_receivablesLabel">
                                    @if(Auth::user()->product_type == 'CFP')
                                    CFP Transaction
                                    @else
                                    Receivable
                                    @endif
                                    Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" method="post" action="{{route('receivables-action')}}" id="addReceivablesForm">
                                    @csrf
                                    <input type="hidden" name="product_type" id="product_type" value="{{Auth::user()->product_type}}" />
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Date</label>
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" name="receivable_date" id="receivable_date" required="" autocomplete="off" readonly="">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                            <div id="receivable_date_err"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Amount</label>
                                            <input type="number" step="0.01" class="form-control" name="amount" id="amount" placeholder="Amount" required="">
                                            <div id="amount_err"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
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
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/front/receivables.js')}}"></script>
@endsection