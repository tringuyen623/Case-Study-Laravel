@extends('front_end.layouts.app')
@section('title', 'Dream Hotel')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(images/img_bg_5.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                            <div class="slider-text-inner text-center">
                                <h2>Welcome to</h2>
                                <h1>{{ general_setting()->name }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(images/img_bg_1.jpg);">

            </li>
            <li style="background-image: url(images/img_bg_3.jpg);">

            </li>
            <li style="background-image: url(images/img_bg_4.jpg);">

            </li>
        </ul>
    </div>
</aside>

@include('front_end.partials.search')

<div id="colorlib-services">
    <div class="container">
        <div class="row">
            @forelse ($hotel->services as $service)
            <div class="col-md-3 animate-box text-center">
                <div class="services">
                    <span class="icon">
                        <i class="{{ $service->icon }}"></i>
                    </span>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-md-12 animate-box text-center">
                <h1 class="text-warning text-center">No Services!</h1>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div id="colorlib-rooms" class="colorlib-light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
                <span><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i
                        class="icon-star-full"></i><i class="icon-star-full"></i></span>
                <h2>Rooms &amp; Suites</h2>
                <p>We love to tell our successful far far away, behind the word mountains, far from the countries
                    Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 animate-box">
                @forelse ($rooms as $room)
                <div class="owl-carousel owl-carousel2">
                    <div class="item">
                        <a href="images/room-1.jpg" class="room image-popup-link"
                            style="background-image: url(images/room-1.jpg);"></a>
                        <div class="desc text-center">
                            <span class="rate-star"><i class="icon-star-full full"></i><i
                                    class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                                    class="icon-star-full"></i><i class="icon-star-full"></i></span>
                            <h3><a href="#">{{ $room->roomType->name }}</a></h3>
                            <p class="price">
                                <span class="currency">$</span>
                                <span class="price-room">99</span>
                                <span class="per">/ per night</span>
                            </p>
                            <p><a class="btn btn-primary btn-book">Book now!</a></p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 animate-box text-center">
                    <h1 class="text-warning text-center">No Services!</h1>
                </div>
                @endforelse
            </div>
            <div class="col-md-12 text-center animate-box">
                <a href="{{ route('rooms')}}">View all rooms <i class="icon-arrow-right3"></i></a>
            </div>
        </div>
    </div>
</div>

<div id="colorlib-testimony" class="colorlib-light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
                <span><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i></span>
                <h2>Our Satisfied Guests says</h2>
                <p>We love to tell our successful far far away, behind the word mountains, far from the countries
                    Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 animate-box">
                <div class="testimony text-center">
                    <span class="img-user" style="background-image: url(images/person2.jpg);"></span>
                    <span class="user">Brian Doe</span>
                    <small>Satisfied Customer</small>
                    <blockquote>
                        <p></i> Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem
                            provident. Odit ab aliquam dolor eius.</p>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4 animate-box">
                <div class="testimony text-center">
                    <span class="img-user" style="background-image: url(images/person1.jpg);"></span>
                    <span class="user">Nathalie Miller</span>
                    <small>Satisfied Customer</small>
                    <blockquote>
                        <p></i> Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem
                            provident. Odit ab aliquam dolor eius.</p>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4 animate-box">
                <div class="testimony text-center">
                    <span class="img-user" style="background-image: url(images/person3.jpg);"></span>
                    <span class="user">Shara Jones</span>
                    <small>Satisfied Customer</small>
                    <blockquote>
                        <p></i> Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem
                            provident. Odit ab aliquam dolor eius.</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection