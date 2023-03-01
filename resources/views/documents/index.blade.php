@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Unsigned Documents</h1>
            </div>
        </div>
        <div class="row">
            @if($unsigned->count() > 0)
            @foreach($unsigned as $unsigned)
            <div class="col-md-3">
                <div class="hover-element case-study-element hover--active">
                    <div class="hover-element__initial text-center">
                        <h6>to be signed...</h6>
                        <p class="lead">{{$unsigned->document_title}}</p>
                        <a class="link-underline" href="https://avanis.co.uk/public/uploads/users/{{Auth::user()->id}}/actions/{{$unsigned->user_action_id}}/{{$unsigned->document_name}}" target="_blank">View and Sign Online</a>
                    </div>
                    <div class="hover-element__reveal" data-overlay="7">
                        <div class="background-image-holder">
                            <img alt="image" src="{{URL::asset('public/images/case-study-2.jpg')}}" />
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-md-12">
                    <p class="lead" style="font-size: 15px;margin-left: 16px">There is no unsigned documents</p>
                </div>
            </div>
            @endif

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Completed Documents</h1>
            </div>
            @if($signed->count() > 0)
            @foreach($signed as $signed)
            <div class="col-md-3">
                <div class="hover-element case-study-element hover--active">
                    <div class="hover-element__initial text-center">
                        <h6>Completed <br/> {{$signed->document_signed_date}}</h6>
                        <p class="lead">
                            {$signed->document_title}
                        </p>
                        <a class="link-underline" href="javascript:;" target="_blank" >View Signed Document</a>
                    </div>
                    <div class="hover-element__reveal" data-overlay="7">
                        <div class="background-image-holder">
                            <img alt="image" src="{{URL::asset('public/images/case-study-2.jpg')}}"  />
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else  
            <div class="row">
                <div class="col-md-12">
                    <p class="lead" style="font-size: 15px;margin-left: 16px">There are no completed documents</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection