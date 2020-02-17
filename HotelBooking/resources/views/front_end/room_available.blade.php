@extends('front_end.layouts.app')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(images/img_bg_5.jpg);">
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

            {{-- <div class="col-md-4 room-wrap animate-box">
                <a href="images/room-2.jpg" class="room image-popup-link"
                    style="background-image: url(images/room-2.jpg);"></a>
                <div class="desc text-center">
                    <span class="rate-star"><i class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                            class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                            class="icon-star-full"></i></span>
                    <h3><a href="rooms-suites.html">Double Room</a></h3>
                    <p class="price">
                        <span class="currency">$</span>
                        <span class="price-room">199</span>
                        <span class="per">/ per night</span>
                    </p>
                    <ul>
                        <li><i class="icon-check"></i> Perfect for traveling couples</li>
                        <li><i class="icon-check"></i> Breakfast included</li>
                        <li><i class="icon-check"></i> Price does not include VAT &amp; services fee</li>
                    </ul>
                    <p><a class="btn btn-primary btn-book" href="{{route('rooms')}}">Book now!</a></p>
                </div>
            </div> --}}

            @foreach ($rooms as $room)
            <div class="col-md-4 room-wrap animate-box">
                <a href="images/room-2.jpg" class="room image-popup-link"
                    style="background-image: url(images/room-2.jpg);"></a>
                <div class="desc">
                    <span class="rate-star"><i class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                            class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                            class="icon-star-full"></i></span>
                    <h3><a href="#">{{ $room->first()->roomType->name }}</a></h3>
                    <input type="hidden" id="roomId" name="id" value="{{ $room->first()->id }}">
                    <p class="price">
                        <span class="currency">{{ $room->first()->view }}</span>
                        <span class="currency">{{ $room->count() }}</span>
                        {{-- <span class="">{{ $room->size }}$</span> --}}
                        <span class="price-room">199</span>
                        <span class="per">/ per night</span>
                    </p>
                    <p>Chi do</p>
                    <ul>
                        <li><i class="icon-check"></i> Perfect for traveling couples</li>
                        <li><i class="icon-check"></i> Breakfast included</li>
                        <li><i class="icon-check"></i> Price does not include VAT &amp; services fee</li>
                    </ul>
                <p><a href="{{ route('room-details-booking', $room->first()->roomType->id).'?arrival='.$search['arrival'].'&departure='.$search['departure'].'&adults='.$search['adults'].'&children='.$search['children'] }}" class="btn btn-primary btn-book" id="book">Book now!</a></p>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection
