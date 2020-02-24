@extends('front_end.layouts.app')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url({{App\HotelGallery::first()->image}});">
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
    <div class="col-md-8">
        @forelse ($rooms as $room)
        <div class="col-md-6 room-wrap animate-box">
            <a href="{{ null !== ($room->first()->roomType->featuredImage()) ? $room->first()->roomType->featuredImage()->image : '' }}"
                class="room image-popup-link"
                style="background-image: url({{ null !== ($room->first()->roomType->featuredImage()) ? $room->first()->roomType->featuredImage()->image : '' }});"></a>
            <div class="desc">
                {{-- <span class="rate-star"><i class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                        class="icon-star-full full"></i><i class="icon-star-full full"></i><i
                        class="icon-star-full"></i></span> --}}
                <h3><a href="#">{{ $room->first()->roomType->name }}</a></h3>
                <input type="hidden" id="roomId" name="id" value="{{ $room->first()->id }}">
                <p class="price">
                    <span
                        class="price-room">{{ hotel_information()->currency_symbol . $room->first()->roomType->base_price }}</span>
                    <span class="per">/ per night</span>
                </p>
                <ul>
                    <li><i class="icon-check"></i> Breakfast included</li>
                    <li><i class="icon-check"></i> Price does not yet include VAT &amp; services fee</li>
                </ul>
                <input type="hidden" id="rates" value="{{$room->first()->roomType->base_price}}">
                <button class="btn btn-primary btn-select" id="book" value="{{ $room->first()->id }}">Select</button>
            </div>
        </div>
        @empty
        <div class="col-md-12 animate-box text-center">
            <h1 class="text-warning text-center">No Room Available on these day!</h1>
        </div>
        @endforelse
    </div>
    <div class="col-md-4">
        {{-- <div class="col-50"> --}}
        <div class="containerblock">
            <form action="{{ route('checkout') }}" method="GET">
            
                <div class="row">
                    <div class="col-50">
                        <h3 class="text-center pb-4"><strong>Bookings summary</strong></h3>
                        <div class="row" id="booking-summary">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="row">
                            <div class="float-left col-md-10">Total rate</div>
                            <div id="total-rates">$0</div>
                        </div>
                        <div class="row">
                            <div class="float-left col-md-10">Total taxes ({{App\Tax::where('type', 'TAX')->first()->rate}}%)</div>
                            <input type="hidden" id="tax" value="{{App\Tax::where('type', 'TAX')->first()->rate}}">
                            <div id="total-taxes">$0</div>
                        </div>
                        <div class="row">
                            <div class="float-left col-md-10">Total fees ({{App\Tax::where('type', 'FEE')->first()->rate}}%)</div>
                            <input type="hidden" id="fee" value="{{App\Tax::where('type', 'FEE')->first()->rate}}">
                            <div id="total-fees">$0</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="float-left col-md-10"><strong>Total for stay</strong></div>
                            <input type="hidden" id="total" name="total-room-charge" value="">
                            <div class="total">$0</div>
                        </div>
                    </div>

                </div>
        </div>
        <button type="button" class="btn btn-primary btn-book">Book</button>
        </form>
    </div>
    {{-- </div> --}}
</div>


</div>
</div>
</div>
@endsection

@push('style')
<style>
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

    /* input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    } */

    /* label {
        margin-bottom: 10px;
        display: block;
    } */

    /* .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    } */

    .btn {
        /* background-color: #4CAF50;
        color: white; */
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
</style>
@endpush

@push('script')
<script>
    var i = 0;
    var adults = {!! json_encode(Session::get('search')['adults']) !!};
    var children = {!! json_encode(Session::get('search')['children']) !!};
    // let totalAdults = adults.toString().split`,`.map(x=>+x).reduce((a,b)=> a+ b, 0);
    // let totalChildren = children.toString().split`,`.map(x=>+x).reduce((a,b)=> a+ b, 0);
    // let totalGuests = totalChildren + totalAdults
    // let totalRooms = {!! json_encode(Session::get('search')['rooms']) !!};
    // let guest;
    // let room;
    
    $(document).ready(function(){
        // totalGuests > 1 ? guest = 'Guests' : guest = 'Guest';
        // totalRooms.length > 1 ? room = 'Rooms' : room = 'Room';
        // let textInfo = `${totalRooms.length} ${room}, ${totalGuests} ${guest}`;

        // $('#info').val(textInfo);
        // var rate = $('-room').val()

        $('.btn-select').click(function(e){
            let roomId = e.target.value;
            let price = e.target.previousElementSibling.value;
            var sumPrice = 0;
            
            if(i < {{ count(Session::get('search')['rooms']) }}){
                $('#booking-summary').append(
                `<div class="col-md-12"><hr>
                    <div class="row">
                        <div class="float-left col-md-10">Room ${i + 1}</div>
                        <input type="hidden" name="roomId" value="${roomId}">
                        <div><input type="hidden" class="price" name="price[]" value="${price}"> $${price}</div>
                    </div>
                    <div class="row">
                        <div class="float-left col-md-12">`+ `${adults[i]}` + ` Adults, ${children[i]} Children</div>
                    </div>
                </div>`)
                i++
                $('input.price').each(function(index){
                sumPrice += parseFloat($(this).val());
            })
            $('#total-rates').html(`$${sumPrice}`)
            let tax = parseFloat($('#tax').val());
            let fee = parseFloat($('#fee').val());
            let totalTax = sumPrice * tax / 100;
            let totalFee = sumPrice * fee / 100;
            let total = sumPrice + totalTax + totalFee;
            $('#total-taxes').html(`$${totalTax}`);
            $('#total-fees').html(`$${totalFee}`);  
            $('.total').html(`$${total}`);
            $('#total').val(total);
            }else {
                $('.btn-book').removeAttr("type").attr("type", "submit");
            }
            })
            $('.btn-book').on('click', function(){
                if($('.btn-book').attr("type") == 'button'){
                alert('Please choose the room first!!!')
                }
            })
            
    })
</script>
@endpush