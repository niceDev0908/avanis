@extends('admin.layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Messages</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Users</a></li>
                <li class="breadcrumb-item active">
                    Messages
                </li>
            </ol>
            <a class="btn btn-dark d-none d-lg-block m-l-15" href="{{ route('admin.users') }}">Back</a>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Message Thread</h5>
            </div>
            <div class="comment-widgets" id="comment" >
                @if($messages->count() > 0)
                @foreach($messages as $m)
                <div class="d-flex no-block comment-row">
                    <div class="p-2">
                        <span class="round">
                            <img src="{{getImage($m->users_with_sender->id, $m->users_with_sender->image)}}" alt="user" width="50">
                        </span>
                    </div>
                    <div class="w-100">
                        <h5 class="font-medium">
                            {{$m->users_with_sender->first_name}} {{$m->users_with_sender->last_name}}
                            <div class="float-right">
                                @if((Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin'))
                                <a class="btn btn-dark delete_record" title="Delete" href="{{route('admin.messages.delete', $m->id)}}">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </a>
                                @endif
                            </div>
                        </h5>
                        <p class="m-b-10 text-muted">{!! nl2br(e($m->message)) !!}</p>
                        <div class="comment-footer">
                            <span class="text-muted pull-right">{{getFormatedDateTime($m->created_at)}}</span>
                        </div>
                    </div>
                </div>
                <hr />
                @endforeach
                @else
                <div class="alert alert-info alert-dismissible fade show m-auto" role="alert">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                    There are no messages yet
                </div>
                @endif
                <div id="add_message"></div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form name="" id="sendMessageForm" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Message</label>
                                    <textarea class="form-control" rows="5" cols="10" name="message" id="message"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="receiver_user_id" value="{{$user_id}}">
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" id="send_message_btn"></i> Send Message</button>
                            <img style="height: auto;width: 50px;display: none;" src="{{URL::asset('public/images/loader.gif')}}" id="messageLoader">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/messages.js')}}"></script>
@endsection