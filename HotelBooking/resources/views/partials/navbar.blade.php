<nav class="colorlib-nav" role="navigation">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-4">
                    <p class="site">www.yoursitehere.com</p>
                </div>
                <div class="col-xs-8 text-right">
                    <p class="num">Call: +01-123-456</p>
                    <ul class="colorlib-social">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="#">Luxehotel</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                        <li>
                        <a href="{{ route('rooms') }}">Rooms</a>
                        </li>
                        {{-- <li><a href="dining-bar.html">Dining &amp; Bar</a></li>
                        <li><a href="aminities.html">Aminities</a></li>
                        <li><a href="blog.html">Blog</a></li> --}}
                        <li><a href="{{ route('about') }}">About</a></li>
                        {{-- <li><a href="{{ route('') }}">Contact</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>