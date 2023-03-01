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
                            <h4 class="mb-sm-0 font-size-18">Files</h4>
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
                                    <li class="breadcrumb-item"><a href="{{route('actions', [$action_arr->receivable_id])}}">Actions</a></li>
                                    <li class="breadcrumb-item active">Files</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">{{$action_arr->title}} - Files</h4>
                                <div class="table-responsive">
                                    @if($action_files->count() > 0)
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 35%" class="align-middle">Title</th>
                                                <th style="width: 20%" class="align-middle">Requested Date</th>
                                                <th style="width: 15%" class="align-middle">Requested By</th>
                                                <th style="width: 15%" class="align-middle">Status</th>
                                                <th style="width: 15%" class="align-middle">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($action_files as $file)
                                            <tr>
                                                <td>{{$file->document_title}}</td>
                                                <td>{{getFormatedDate($file->created_at)}}</td>
                                                <td>
                                                    <img class="rounded-circle avatar-xs" src="{{ URL::asset('public/images/default-user.jpg') }}"> Avanis Support
                                                </td>
                                                <td>
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
                                                <td>
                                                    @if($file->user_action->is_request_document == 0)
                                                    @if($file->is_signed == 0)
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                        <a href="{{$file->document_url}}" target="_blank" style="color: #FFF;">
                                                            View & Sign
                                                        </a>
                                                    </button>
                                                    @elseif($file->is_signed == 1)
                                                    <a class="btn btn-dark" title="Download" href="{{URL::to('/')}}/public/uploads/users/{{Auth::user()->id}}/actions/{{$file->user_action_id . '/' . $file->document_name}}" download="{{$file->document_name}}">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
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
                                        There are no files
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