@extends('front_end.layouts.app')

@section('content')

<section class="room-details-area">
    <div class="col-md-12 text-center pb-60">
        <h1><strong>CONFIRM & CHECKOUT</strong></h1>
    </div>
    <div class="container" style="padding-bottom: 60px">
        <div class="row">
            <div class="col-75">
                <div class="containerblock">
                    <form action="/action_page.php">

                        <div class="row">
                            <div class="col-50">
                                <h3>Guest Information</h3>
                                <div class="row">
                                    <div class="col-md-4 pb-2">
                                        <label for="gender"><i class="fa fa-user"></i> Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="0">Mr</option>
                                            <option value="1">Ms</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="fname">First Name</label>
                                        <input type="text" id="fname" name="first_name" placeholder="M. Doe">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="fname">Last Name</label>
                                        <input type="text" name="last_name" placeholder="John">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="fname"><i class="fa fa-phone"></i> Phone</label>
                                        <input type="text" name="phone" placeholder="00-xxxx">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="fname"><i class="fa fa-envelope"></i> Email</label>
                                        <input type="text" name="email" placeholder="john@example.com">
                                    </div>
                                </div>

                            </div>

                            <div class="col-50">
                                <h3>Payment</h3>
                                <label for="fname">Accepted Cards</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>
                                <label for="cname">Name on Card</label>
                                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                <label for="ccnum">Credit card number</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                                <label for="expmonth">Exp Month</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="September">
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Exp Year</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2018">
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Continue to checkout" class="btn">
                    </form>
                </div>
            </div>
            <div class="col-25">
                <div class="containerblock">
                    <h2><strong>Booking Details</strong> <span class="price" style="color:black"></span>
                    </h2>
                    <p>Arrival <span class="price">{{ Session::get('search')['arrival'] }}</span></p>
                    <p>Departure <span class="price">{{ Session::get('search')['departure'] }}</span></p>
                    <p>Total Nights <span
                            class="price">{{ $numberOfNights }}</span>
                    </p>
                    <p>Total Guest <span
                            class="price">{{ array_sum(Session::get('search')['adults']) + array_sum(Session::get('search')['children']) }}</span>
                    </p>
                    <p>Total Rooms <span class="price">{{ count(Session::get('search')['rooms']) }}</span></p>
                    <hr>
                    <p><b>Total room charge</b> <span class="price" style="color:black"><b>${{ $roomCharge }}</b></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('style')
<style>
    .row {
        display: -ms-flexbox;
        /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap;
        /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%;
        /* IE10 */
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
        padding: 0 16px;
    }

    .containerblock {
        background-color: #f2f2f2;
        padding: 20px 20px 15px 20px;
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

@endpush