<footer id="colorlib-footer" role="contentinfo">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-4 colorlib-widget">
                <h4>{{ hotel_information()->name }}</h4>
                <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci
                    architecto culpa amet.</p>
                <p>
                    <ul class="colorlib-social-icons">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                </p>
            </div>
            <div class="col-md-4 colorlib-widget">
                <h4>Quick Links</h4>
                <p>
                    <ul class="colorlib-footer-links">
                        <li><a href="{{ route('room-list') }}">Accomodation</a></li>
                        <li><a href="#">Dining &amp; Bar</a></li>
                        <li><a href="#">Restaurants</a></li>
                    </ul>
                </p>
            </div>

            <div class="col-md-4 col-md-push-1">
                <h4>Contact Information</h4>
                <ul class="colorlib-footer-links">
                    <li class="fa fa-map-marker"> {{hotel_information()->address}}</li>
                    <li class="fa fa-phone"> <a href="tel://1234567920">{{hotel_information()->phone}}</a></li>
                    <li class="fa fa-envelope-o"> <a href="mailto:info@yoursite.com">{{hotel_information()->email}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>