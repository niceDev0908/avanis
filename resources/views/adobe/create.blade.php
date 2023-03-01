@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            @include('flash-message')
            <form class="form-email" enctype="multipart/form-data" method="post" action="{{ route('adobe.upload-doc-action') }}">
                @csrf
                <div class="boxed">
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <label>Upload Document:</label>
                                <input class="validate-required" type="file" name="file"/>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn">
                                <span class="btn__text">
                                    Upload Doc
                                </span>
                            </button>                          
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection