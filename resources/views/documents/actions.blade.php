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
                            <h4 class="mb-sm-0 font-size-18">Documents</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('receivable-actions')}}">
                                            @if(Auth::user()->product_type == 'CFP')
                                            CFP Transactions
                                            @else
                                            Receivables
                                            @endif
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Documents</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="row mb-3">
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="mt-2">
                                                <h5>Documents</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        @if($actions->count() > 0)
                                        @foreach($actions as $action)
                                        <div class="col-xl-3 col-sm-4">
                                            <div class="card shadow-none border">
                                                <div class="card-body p-3">
                                                    <div class="">
                                                        <div class="float-end ms-2">
                                                            <div class="dropdown mb-2">
                                                                <a class="font-size-16 text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="{{route('action-files', ['id' => $action->id])}}">View Documents</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="float-end ms-2"></div>
                                                        <div class="avatar-xs me-3 mb-3">
                                                            <div class="avatar-title bg-transparent rounded">
                                                                <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="overflow-hidden me-auto">
                                                                <h5 class="font-size-14 text-truncate mb-1">
                                                                    <a href="{{route('action-files', ['id' => $action->id])}}" class="text-body">{{$action->title}}</a>
                                                                </h5>
                                                                <p class="text-muted text-truncate mb-0">{{count($action->user_action_documents)}} Document(s)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                                            There are no documents
                                        </div>
                                        @endif
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
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
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/front/profile.js')}}"></script>
@endsection