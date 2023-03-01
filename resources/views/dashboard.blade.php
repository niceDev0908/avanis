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
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end dropdown ms-2">
                                    <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </a>
                                </div>
                                <div>
                                    <div class="mb-4 me-3">
                                        <i class="mdi mdi-account-circle text-primary h1"></i>
                                    </div>
                                    <div>
                                        <h5>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                                        <p class="text-muted mb-1">{{Auth::user()->email}}</p>
                                        <p class="text-muted mb-0">&nbsp;</p>
                                        <p class="text-muted mb-0">&nbsp;</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top" style="padding-bottom: 82px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <p class="fw-medium mb-2">Support Plan</p>
                                            <h5>Included</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mt-4 mt-sm-0">
                                            <p class="fw-medium mb-2">Active</p>
                                            <div class="d-inline-flex align-items-center mt-1" id="tooltip-container">
                                                <a href="javascript: void(0);" class="m-1">
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-warning bg-soft text-warning font-size-18">
                                                            <i class="mdi mdi-handshake"></i>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div>
                                <div class="row">
                                    <div class="col-lg-9 col-sm-8">
                                        <div  class="p-4">
                                            <h5 class="text-primary">Welcome {{Auth::user()->first_name}} {{Auth::user()->last_name}} !</h5>
                                            <p>Dashboard</p>

                                            <div class="text-muted">
                                                <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> You will require a smartphone or touch display to sign documentation.</p>
                                                <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Important messages about your Avanis membership will be displayed in the ‘Notifications’ tab below.</p>
                                                <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> All required off-line actions will be displayed in th ‘Tasks’ tab below.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 align-self-center">
                                        <div>
                                            <img src="{{ URL::asset('public/assets/images/dashboard-laptop.png') }}" alt="" class="img-fluid d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body" style="padding-bottom: 58px;">
                                        <p class="text-muted mb-4"><i class="mdi mdi-account-details-outline h2 text-primary align-middle mb-0 me-3"></i> Avanis PMC audit last carried out: </p>

                                        <div class="row">
                                            <div class="col-6">
                                                <div>
                                                    <!--<h5>£ 0.00</h5>-->
                                                    <!--<p class="text-muted text-truncate mb-0">Outstanding... </p>-->
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <div id="area-sparkline-chart-2" class="apex-charts"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body" style="min-height: 145px;">
                                        <p class="text-muted mb-4">
                                            <i class="mdi mdi-file-document-multiple-outline h2 text-primary align-middle mb-0 me-3"></i>
                                            Personal fact find details:
                                            <button type="button" class="btn btn-primary waves-effect waves-light" style="float: right;">
                                                <a href="{{route('annual-compliance')}}" style="color: #FFF;">Update</a>
                                            </button>
                                        </p>

                                        <div class="row">
                                            <div class="col-6">
                                                <div>
                                                    @if(@$annual_compliance->updated_at != "" && @$annual_compliance->updated_at != "0000-00-00 00:00:00")
                                                    <h6>Updated on:</h6>
                                                    <h6>{{ getFormatedDate(@$annual_compliance->updated_at) }}</h6>
                                                    @endif
                                                    <p class="text-muted mb-0">

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    @if(@$annual_compliance->approved_date != "" && @$annual_compliance->approved_date != "0000-00-00 00:00:00")
                                                    <h6>Approved on:</h6>
                                                    <h6>{{ getFormatedDate(@$annual_compliance->approved_date) }}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header bg-transparent border-bottom">
                                <div class="d-flex flex-wrap">
                                    <div class="me-2">
                                        <h5 class="card-title mt-1 mb-0">Notifications</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div data-simplebar style="max-height: 295px;">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="post-recent" role="tabpanel">
                                            <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                                                There are no notifications
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header bg-transparent border-bottom">
                                <div class="d-flex flex-wrap">
                                    <div class="me-2">
                                        <h5 class="card-title mt-1 mb-0">Tasks</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div data-simplebar style="max-height: 295px;">
                                    <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                                        There are no tasks
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Actions Required</h4>
                                <div class="table-responsive">
                                    @if($action_files->count() > 0)
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 10%" class="align-middle">
                                                @if(Auth::user()->product_type == 'CFP')
                                                Deposit
                                                @else
                                                Receivable
                                                @endif
                                                </th>
                                                <th style="width: 20%" class="align-middle">Action Title</th>
                                                <th style="width: 20%" class="align-middle">Document Title</th>
                                                <th style="width: 10%" class="align-middle text-center">Requested Date</th>
                                                <th style="width: 15%" class="align-middle text-center">Requested By</th>
                                                <th style="width: 10%" class="align-middle text-center">Status</th>
                                                <th style="width: 15%" class="align-middle text-center">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($action_files as $file)
                                            <tr>
                                                <td>
                                                    @if($file->user_action->receivable_id == 0)
                                                    Other
                                                    @else
                                                    £ {{@$file->user_action->receivable->amount}} - {{getFormatedDate(@$file->user_action->receivable->date)}}
                                                    @endif
                                                </td>
                                                <td>{{@$file->user_action->title}}</td>
                                                <td>{{$file->document_title}}</td>
                                                <td class="text-center">{{getFormatedDate($file->created_at)}}</td>
                                                <td class="text-center">
                                                    <img class="rounded-circle avatar-xs" src="{{ URL::asset('public/images/default-user.jpg') }}"> Avanis Support
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                    $status_class = "";
                                                    if($file->is_signed == 0) {
                                                    $status_class = "badge-soft-danger";
                                                    } else if($file->is_signed == 1) {
                                                    $status_class = "badge-soft-success";
                                                    }
                                                    @endphp
                                                    <span class="badge badge-pill {{$status_class}} font-size-11">
                                                        @if($file->is_signed == 0)
                                                        Pending
                                                        @elseif($file->is_signed == 1)
                                                        Completed
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if($file->user_action->is_request_document == 0)
                                                    @if($file->is_signed == 0)
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                        <a href="{{$file->document_url}}" target="_blank" style="color: #FFF;">
                                                            View & Sign
                                                        </a>
                                                    </button>
                                                    @elseif($file->is_signed == 1)
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                        <a href="{{URL::to('/')}}/public/uploads/users/{{Auth::user()->id}}/actions/{{$file->user_action_id . '/' . $file->document_name}}" target="_blank" style="color: #FFF;">
                                                            View
                                                        </a>
                                                    </button>
                                                    @endif
                                                    @else
                                                    @if($file->is_signed == 1)
                                                    <a href="{{route('view-requested-uploaded-documents', $file->id)}}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">View</a>
                                                    @endif
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light upload_action_documents" data-bs-toggle="modal" data-bs-target=".upload_documents" data-action-id="{{$file->user_action_id}}" data-action-document-id="{{$file->id}}">Upload</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                                        There are no actions
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade upload_documents" tabindex="-1" role="dialog" aria-labelledby=upload_documentsLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id=upload_documentsLabel">Upload</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <form class="dropzone" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="action_id" id="action_id" />
                                                        <input type="hidden" name="action_document_id" id="action_document_id" />
                                                        <div class="fallback">
                                                            <input name="requested_documents[]" type="file" multiple="multiple">
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                            </div>

                                                            <h4>Drop files here or click to upload.</h4>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="text-center mt-4">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-upload-document">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<script>
    var Dropzone = new Dropzone(".dropzone", {
        url: "{{route('upload-requested-document')}}",
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 100,
        complete: function (file, done) {
            //alert(1)
        },
        queuecomplete: function (file, done) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url + 'dashboard/after_file_uploaded',
                type: 'POST',
                data: {
                    action_document_id: $('#action_document_id').val()
                }
            }).done(function (data) {
                window.location.reload();
            });
        },
    });
    $('.upload_action_documents').click(function () {
        var action_id = $(this).attr('data-action-id');
        var doc_id = $(this).attr('data-action-document-id');
        $('#action_id').val(action_id);
        $('#action_document_id').val(doc_id);
    });
    $('#btn-upload-document').click(function () {
        Dropzone.processQueue();
    });
</script>
@endsection