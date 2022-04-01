<!-- Footer Area HTML Start -->
    <footer>
        <div class="container">
            <div class="row">
            <div class="col-lg-3">
                <div class="single-footer">
                    <a href="{{ url('/') }}"><img class="img-fluid" src="{{ asset('uploads/'.setting()->footer_logo) }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-footer">
                    <p>{{ setting()->footer_description }}</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-footer">
                <div class="title">
                    <h3>Contact us</h3>
                </div>
                <ul>
                    <li><b>Phone: </b><a href="tel:{{ setting()->phone_one }}">{{ setting()->phone_one }}</a></li>
                    @if (setting()->phone_two)
                        <li><b>Phone: </b><a href="tel:{{ setting()->phone_two }}">{{ setting()->phone_two }}</a></li>
                    @endif
                    <li class="icon"><a href="{{ setting()->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="icon"><a href="{{ setting()->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </footer>
<!-- Footer Area HTML Start -->