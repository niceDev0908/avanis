@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3 boxed-sidebar">
                @include('layouts.left-sidebar')
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Delete Account</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-sm-8">
                        <h4 style="font-size: 15px;">ARE YOU SURE YOU WANT TO DELETE YOUR ACCOUNT?</h4>
                        <p>You will loose all your data and your account will be permanently deleted
                            from our records and you will not be able to undo this action.
                        </p>
                    </div>
                    <div class="col-md-9 col-sm-8 text-center">
                        <a href="javascript:void(0);" data-id="{{Auth::user()->id}}"class="delete_account btn btn-primary primary-btn">
                            Delete Account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/front/delete-account.js')}}"></script>
@endsection