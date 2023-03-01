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
                                    <li class="breadcrumb-item active">Documents</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($documents as $key => $value)
                            <div class="col-xl-2 col-6">
                                <div class="card">
                                    <div style="min-height: 132px; text-align: center;">
                                        @if(substr($value->document_name, -3) == "pdf")
                                        <img class="card-img-top img-fluid" src="{{ URL::asset('public/images/pdf.png') }}" style="width: 64px; height: auto;">
                                        @elseif(substr($value->document_name, -4) == "docx" || substr($value->document_name, -3) == "doc")
                                        <img class="card-img-top img-fluid" src="{{ URL::asset('public/images/word.png') }}" style="width: 64px; height: auto;">
                                        @else
                                        <img class="card-img-top img-fluid" src="{{ URL::asset('public/uploads/users/' . Auth::user()->id . '/actions/' . $value->action_document->user_action_id . '/' . $value->action_document->id . '/' . $value->document_name) }}" style="max-width: 200px; height: auto;">
                                        @endif
                                    </div>
                                    <div class="py-2 text-center">
                                        @php
                                        $file_name = explode("_", $value->document_name);
                                        unset($file_name[0]);
                                        $file_name = implode("_", $file_name);
                                        @endphp
                                        <a href="javascript:void(0);" data-file-name="{{$file_name}}" data-url="{{ URL::asset('public/uploads/users/' . Auth::user()->id . '/actions/' . $value->action_document->user_action_id . '/' . $value->action_document->id . '/' . $value->document_name) }}" class="fw-medium download-file">Download</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a class="btn btn-primary" href="javascript:void(0);" onclick="window.history.go(-1); return false;">Back</a>
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
<script src="{{URL::asset('public/js/front/view-requested-uploaded-documents.js')}}"></script>
@endsection