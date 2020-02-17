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
            <div class="col-lg-6 col-md-12">
                <div class="room-wrap animate-box">
                    <a href="images/room-2.jpg" class="room image-popup-link"
                        style="background-image: url(/images/room-2.jpg);"></a>
                    <div class="desc">
                        <span class="rate-star"><i class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                                class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                                class="icon-star-full"></i></span>
                        <h3><a href="#">{{ $room->name }}</a></h3>
                        <input type="hidden" id="roomId" name="id" value="{{ $room->first()->id }}">
                        <p class="price">
                            {{-- <span class="currency">{{ $room->first()->view }}</span> --}}
                            {{-- <span class="currency">{{ $room->count() }}</span> --}}
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
                        {{-- <p><a href="{{ route('room-details', $room->first()->roomType->id).'?arrival='.$search['arrival'].'&departure='.$search['departure'].'&adults='.$search['adults'].'&children='.$search['children'] }}"
                        class="btn btn-primary btn-book" id="book">Book now!</a></p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="desc">
                    <form role="form" action="{{ route('booking', $room->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <h4 class="text-center" style="font-family: 'Poppins'"><strong>BOOKING</strong></h4>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" style="width: auto" name="gender" id="gender">
                                <option value="0">Mr</option>
                                <option value="1">Ms</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="exampleInputEmail1"
                                value="{{ $room->view }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="exampleInputPassword1"
                                value="{{ $room->size }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                                value="{{ $room->size }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputPassword1"
                                value="{{ $room->size }}">
                        </div>
                        <div class="form-group">
                        <div class="col-md-6"><input type="text" name="adults" value="{{$search['adults']}}"></div>
                        <div class="col-md-6"><input type="text" name="children" value="{{$search['children']}}"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6"><input type="text" name="arrival" value="{{$search['arrival']}}"></div>
                            <div class="col-md-6"><input type="text" name="departure" value="{{$search['departure']}}"></div>
                            </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Booking</button>
                        </div>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                </form>
            </div>
        </div>



    </div>
</div>
</div>
@endsection

@push('style')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
@endpush