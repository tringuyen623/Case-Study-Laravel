@extends('front_end.layouts.app')
@section('title', 'Room List')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url({{App\GalleryCategory::where('name','Room')->get()->first()->hotelGalleries->random()->image}});">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                            <div class="slider-text-inner slider-text-inner2 text-center">
                                <h2>Choose our Best</h2>
                                <h1>Rooms &amp; Suites</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

@include('front_end.partials.search')

<div id="colorlib-rooms" class="colorlib-light-grey">
    <div class="container">
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-md-4 room-wrap animate-box">
                <a href="{{ null !== ($room->featuredImage()) ? $room->featuredImage()->image : '' }}" class="room image-popup-link"
                    style="background-image: url({{ null !== ($room->featuredImage()) ? $room->featuredImage()->image : '' }});"></a>
                <div class="desc">
                    <h3><a href="#">{{ $room->name }}</a></h3>
                    <p class="price">
                        <span class="currency">{{ $room->description }}</span>
                    </p>
                    <p class="price">
                        <span class="price-room">{{hotel_information()->currency_symbol . $room->base_price}}</span>
                        <span class="per">/ per night</span>
                    </p>
                    <ul>
                        <li><i class="icon-check"></i> Breakfast included</li>
                        <li><i class="icon-check"></i> Price does not include VAT &amp; services fee</li>
                    </ul>
                    <p><a class="btn btn-primary btn-book" href="{{route('room-list')}}">Book now!</a></p>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection