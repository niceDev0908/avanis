@extends('layouts.app')

@section('content')
<section class="imagebg height-80 imagebg section-hero-1 bg--primary" data-overlay="7">
    <div class="background-image-holder">
        <img alt="image" src="{{URL::asset('public/images/home1.jpg')}}" />
    </div>
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h3>
                    Global Client Administration Portal
                    <br /> Registration and Documents.
                </h3>
                <p>
                    <strong>Contact your financial representative before registering for your Avanis account.</strong>
                </p>
                <a href="{{route('register')}}" class="btn btn--white btn--unfilled">
                    <span class="btn__text">
                        Register an Avanis Account
                    </span>
                    <i class="ion-arrow-right-c"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')

@endsection