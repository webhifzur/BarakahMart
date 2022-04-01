@extends('layouts.frontend_app')

@section('frontend_content')
@include('layouts.sidebar_responsive_app')

  
    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
      <div class="container">
        <div class="text">
          <h1>Single Category</h1>
          <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li>></li>
              <li>{{ $shopcategory->type }}</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Inner Banner HTML End -->
    
    <!-- category Area HTML Start -->
     <section class="category-area section-padding">
        <div class="container">
          <div class="row">
            @foreach ($subcategories as $subcategory)
              <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6">
                <a href="{{ route('single.subcategory',$subcategory->slug) }}">
                  <div class="single-category">
                    <img src="{{ asset('uploads/'.$subcategory->image) }}" alt="">
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    <!-- category Area HTML End -->

     @include('layouts.footer_app')
    
@endsection