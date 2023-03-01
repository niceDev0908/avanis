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
                            <h4 class="mb-sm-0 font-size-18">Messages</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Avanis</a></li>
                                    <li class="breadcrumb-item active">Messages</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-lg-flex">
                    <div class="w-100 user-chat">
                        <div class="card">
                            <div>
                                <div class="chat-conversation p-3">
                                    <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;" id="messages_div">
                                        @if($messages->count() > 0)
                                        @foreach($messages as $m)
                                        <li class="{{($m->sender_id == Auth::user()->id) ? 'right' : ''}}">
                                            <div class="conversation-list">
                                                <div class="ctext-wrap">
                                                    <div class="conversation-name">{{$m->users_with_sender->first_name}} {{$m->users_with_sender->last_name}}</div>
                                                    <p>{!! nl2br(e($m->message)) !!}</p>
                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{getFormatedDateTime($m->created_at)}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                        <div id="add_message"></div>
                                    </ul>
                                </div>
                                <div class="p-3 chat-input-section">
                                    <form class="form-email" id="sendMessageForm" method="post" action="javascript:void(0);">
                                        @csrf
                                        <input type="hidden" name="receiver_user_id" value="{{config('app.super_admin_id')}}">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <textarea class="form-control chat-input" name="message" id="message" placeholder="Enter Message..." rows="5" cols="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light" id="send_message_btn" style="margin-top: 30px;">
                                                    <span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i>
                                                </button>
                                                <div class="spinner-border text-primary m-1" role="status" id="messageLoader" style="display: none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
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
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/front/messages.js')}}"></script>
@endsection