@extends('front_end.layouts.app')
@section('title','Room Details')
@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li
                style="background-image: url({{App\GalleryCategory::where('name','Room')->get()->first()->hotelGalleries->random()->image}});">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                            <div class="slider-text-inner slider-text-inner2 text-center">
                                <h1>Room Details</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

@include('front_end.partials.search')

<section class="room-details-area section-padding pt-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 pb-60">
                <div class="room-gallery wow fadeInUp" data-wow-delay="0.3s">

                    <!--Carousel Wrapper-->
                    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            <!--First slide-->
                            @foreach($roomType->images as $key=>$image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : null }}">
                                <img class="d-block w-100" src="{{$image->image}}">
                            </div>
                            @endforeach

                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                    </div>
                    <!--/.Carousel Wrapper-->
                </div>
                <div class="room-details-content wow fadeInUp" data-wow-delay="0.4s">
                    <h2 class="cl-black"><a href="" class="cl-black">{{$roomType->name}}</a></h2>
                    {{ $roomType->description }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="room-reviews">
                                <div class="blog-comments">
                                    <div class="fb-comments" data-width="100%" data-href="{{url()->current()}}"
                                        data-numposts="5">
                                    </div>
                                    <div id="fb-root"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay="0.4s">
                <div class="page-sidebar">
                    <div class="bg-base price-tag pb-2 pt-3">
                        <h3>Room Details</h3>
                    </div>
                    <div class="border-base bg-light price-tag  mb-2">
                        <dl class="row">
                            <dt class="col-md-6">Name :</dt>
                            <dd class="col-md-6">{{$roomType->name}}</dd>
                            <dt class="col-md-6">Short Code :</dt>
                            <dd class="col-md-6">{{$roomType->short_code}}</dd>
                            <dt class="col-md-6">Higher Capacity :</dt>
                            <dd class="col-md-6">{{$roomType->higher_capacity}}</dd>
                            <dt class="col-md-6">Kids Capacity :</dt>
                            <dd class="col-md-6">{{$roomType->kids_capacity}}</dd>
                            <dt class="col-md-6">Amenities :</dt>
                            <dd class="col-md-6">
                                @foreach($roomType->amenities as $amenity)
                                <span class="badge bg-tsk text-white">{{$amenity->name}}</span>
                                @endforeach
                            </dd>
                            <dt class="col-md-6">Base Price :</dt>
                            <dd class="col-md-6"><strong>{{number_format($roomType->base_price,2)}}</strong>
                                {{hotel_information()->currency}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('style')
<style>
    .cl-black {
        color: #222222;
        padding-top: 10px;
    }

    .carousel .carousel-indicators li {
        width: .625rem;
        height: .625rem;
        cursor: pointer;
        border-radius: 50%;
    }

    .pt-60 {
        padding-top: 60px;
    }

    .pb-60 {
        padding-bottom: 60px;
    }

    .border-base {
        border: 1px solid #4586FF;
    }

    .bg-base {
        background: #4586FF;
        color: #fff;
    }

    .color-base {
        color: #ff0502;
    }

    .border-color-base {
        border-color: #ff0502;
    }



    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        position: relative;
        font-weight: normal;
        margin: 0px;
        background: none;
        line-height: 1.6em;
        /* font-family: 'Roboto', sans-serif; */
    }

    h2 {
        font-size: 36px;
        font-weight: 600;
        line-height: 40px;
    }

    h3 {
        font-size: 22px;
        line-height: 26px;
        font-weight: 600;
        color: #fff;
    }

    input,
    button,
    select,
    textarea {}

    textarea {
        overflow: hidden;
    }

    p {
        position: relative;
        line-height: 1.8em;
        font-size: 16px;
        color: #5e5e5e;
    }


    img {
        -webkit-user-drag: none;
        -khtml-user-drag: none;
        -moz-user-drag: none;
        -o-user-drag: none;
    }

    .page-wrapper {
        position: relative;
        margin: 0 auto;
        width: 100%;
        min-width: 300px;
        overflow: hidden;
    }

    ul,
    li {
        list-style: none;
        padding: 0px;
        margin: 0px;
    }

    img {
        display: inline-block;
        max-width: 100%;
    }

    .w-100 {
        height: 400px;
    }

    .btn.focus,
    .btn:focus {
        box-shadow: none;
    }

    .border-0 {
        border: 0px;
    }

    .centered {
        text-align: center;
    }

    .room-details-content h2 {
        margin-bottom: 20px;
    }


    .room-details-content p {
        margin-bottom: 20px;
    }

    .room-details-content ul li {
        margin-bottom: 10px;
    }

    .room-details-content ul li i {
        margin-right: 10px;
        color: #3EA35F;
    }


    .room-reviews h2 {
        border-bottom: 1px solid #ECECEC;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .room-ratings i {
        margin-right: -4px;
        color: #fb2f61;
    }

    .room-single-review {
        border-bottom: 1px solid #ECECEC;
        margin-bottom: 30px;
    }


    .room-single-review:last-child {
        border-bottom: 0px solid #ECECEC;
        margin-bottom: 0;
    }


    .price-tag,
    .booking-form {
        padding: 30px 25px;
    }

    .price-tag h4 {
        font-size: 22px;
        color: #141414;
        font-weight: 700;
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }

    .price-tag h4 span {
        font-size: 16px;
        font-weight: 400;
    }


    .booking-form {}

    .booking-form input,
    .booking-form select {
        width: 100%;
        border: 1px solid #CCCCCC;
        height: 50px;
        border-radius: 4px;
        text-indent: 10px;
        margin-bottom: 20px;
        transition: .4s;
    }

    .booking-form input:focus,
    .booking-form select:focus {
        border: 1px solid #fb2f61;
    }


    .booking-form button {
        font-size: 16px;
        font-weight: 400;
        padding: 12px 36px;
        letter-spacing: .3px;
        border-radius: 4px;
        display: inline-block;
        color: #fff !important;
        cursor: pointer;
    }

    .booking-form button:hover {}


    .slider-wrapper {
        width: auto;
    }

    .slider-for__item img {
        width: 100%;
    }

    .slider-nav__item {}

    .slick-slide {
        margin-bottom: 30px;
    }

    .room-gallery .slick-track {
        display: inline-block;
    }
</style>
@endpush