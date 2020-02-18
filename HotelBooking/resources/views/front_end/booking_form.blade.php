@extends('front_end.layouts.app')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(/images/img_bg_5.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                            <div class="slider-text-inner slider-text-inner2 text-center">
                                <h1>Rooms Details</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

@include('front_end.partials.search')

<div class="container">
    <div class="row-1">

        <div class="col-50">
            <div id="colorlib-rooms" class="colorlib-light-grey">
                <div class="room-wrap animate-box">
                    <a href="images/room-2.jpg" class="room image-popup-link"
                        style="background-image: url(/images/room-2.jpg);"></a>
                    <div class="desc">
                        <h3><a href="#">{{ $room->roomType->name }}</a></h3>
                        {{-- <input type="hidden" id="roomId" name="id" value="{{ $room->first()->id }}"> --}}
                        <p class="price">
                            {{-- <span class="currency">{{ $room->first()->view }}</span> --}}
                            {{-- <span class="currency">{{ $room->count() }}</span> --}}
                            {{-- <span class="">{{ $room->size }}$</span> --}}
                            <span class="price-room">199</span>
                            <span class="per">/ per night</span>
                        </p>
                        <ul>
                            {{-- <li><i class="icon-check"></i> Perfect for traveling couples</li>
                            <li><i class="icon-check"></i> Breakfast included</li>
                            <li><i class="icon-check"></i> Price does not include VAT &amp; services fee</li> --}}
                        </ul>
                        {{-- <p><a href="{{ route('room-details', $room->first()->roomType->id).'?arrival='.$search['arrival'].'&departure='.$search['departure'].'&adults='.$search['adults'].'&children='.$search['children'] }}"
                        class="btn btn-primary btn-book" id="book">Book now!</a></p> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-50">
            <div class="containerblock">
                <form action="{{ route('booking') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-50">
                            <h3 class="text-center"><strong>Booking</strong></h3>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="gender"><i class="fa fa-user"></i> Gen</label>
                                    <select class="form-control" style="width: auto; height: 50px" name="gender"
                                        id="gender">
                                        <option value="0">Mr</option>
                                        <option value="1">Ms</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="first_name" placeholder="M. Doe">
                                </div>
                                <div class="col-md-5">
                                    <label for="fname">Last Name</label>
                                    <input type="text" name="last_name" placeholder="John">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fname"><i class="fa fa-phone"></i> Phone</label>
                                    <input type="text" name="phone" placeholder="00-xxxx">
                                </div>
                                <div class="col-md-6">
                                    <label for="fname"><i class="fa fa-envelope"></i> Email</label>
                                    <input type="text" name="email" placeholder="john@example.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fname"><i class="fa fa-calendar"></i> Arrival</label>
                                    <input type="text" name="arrival" value="{{$search['arrival']}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="fname"><i class="fa fa-calendar"></i> Departure</label>
                                    <input type="text" name="departure" value="{{$search['departure']}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fname"><i class="fa fa-user"></i> Adults</label>
                                    <input type="text" name="adults" value="{{$search['adults']}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="fname"><i class="fa fa-child"></i> Children</label>
                                    <input type="text" name="children" value="{{$search['children']}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="submit" value="Book" class="btn">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
    #colorlib-rooms {
        padding: 0;
    }

    .row-1 {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin: 0 -16px;
        padding: 84px 0 84px 0;
    }

    .col-25 {
        -ms-flex: 25%;
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%;
        /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%;
        /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 20px 16px 0 16px;
    }

    .containerblock {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }

        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
@endpush