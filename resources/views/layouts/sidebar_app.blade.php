<!-- Navber HTML Start -->
    <div class="big-scren">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/#offer') }}"><img class="left-icon" src="{{ asset('uploads/category/offer.png') }}" alt=""> Offer <span class="offer_no">{{ offer_count() }}</span></a>
              </li>
              <hr>
              @foreach ($categories as $category)
              @if (!subcategory_count($category->id))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('single.category',$category->slug) }}">
                    <img class="left-icon" src="{{ asset('uploads/'.$category->icon_image) }}" alt="">
                    {{ $category->type }}
                  </a>
                </li>
              @endif
                @if (subcategory_count($category->id))
                  <li class="nav-item dropdown">
                    <a class="nav-link icon" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img class="left-icon" src="{{ asset('uploads/'.$category->icon_image) }}" alt="">{{ $category->type }}<i class="fas fa-angle-right right-icon"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      @foreach (subcategory($category->id) as $item)
                        <li><a class="dropdown-item" href="{{ route('single.subcategory',$item->slug) }}"><i class="fas fa-chevron-right"></i>{{ $item->type }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      </nav> 
    </div>
    <div class="responsive-scren">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/#offer') }}"><img class="left-icon" src="{{ asset('uploads/category/offer.png') }}" alt=""> Offer <span class="offer_no">{{ offer_count() }}</span></a>
              </li>
              @foreach ($categories as $category)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('single.category',$category->slug) }}"><img class="left-icon" src="{{ asset('uploads/'.$category->icon_image) }}" alt="">{{ $category->type }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </nav> 
    </div>
<!-- Navber HTML End -->