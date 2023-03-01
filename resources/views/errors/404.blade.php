@extends('layouts.app')

@section('content')
<section class="height-100 bg--primary">
      <div class="container pos-vertical-center">
          <div class="row">
              <div class="col-sm-12 text-center">
                  <h2>
                      <i class="icon--lg icon-lifesaver"></i>
                  </h2>
                  <h1>
                      Oops - Page Not Found
                  </h1>
                  <p>
                      THE PAGE YOU WERE LOOKING FOR DOESN'T EXIST.
                      <br /> 
                      You may have mistyped the address or the page may have moved.
                      <br>
                  </p>
                  <p>For more information please email <a href = "mailto: info@avanis.co.uk">info@avanis.co.uk</a></p>
                  <a class="link-underline" href="{{route('home')}}">Go back home</a>
              </div>
          </div>
      </div>
  </section>
@endsection