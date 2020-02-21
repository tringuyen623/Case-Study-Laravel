@extends('front_end.layouts.app')

@section('content')

<section class="room-details-area section-padding pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 wow fadeInLeft" data-wow-delay="0.4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                <div class="page-sidebar">
                    <div class="single-sidebar-block price-tag">
                        <h4>Guest Details</h4>
                        <div>
                            <strong>{{ ($cusDetails['gender'] == 0 ? 'Mr' : 'Ms') . '. ' . $cusDetails['first_name'] . ' ' . $cusDetails['last_name'] }}</strong><br>
                            Phone: {{ $cusDetails['phone']}}<br>
                            Email: {{ $cusDetails['email']}}
                        </div>
                    </div>
                    <div class="single-sidebar-block price-tag">
                        <h4>Booking Details</h4>
                        <div>
                            <dl class="row">
                                <dt class="col-md">Booking ID</dt>
                                <dd class="col-md">{{ $booking->id }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Room Type</dt>
                                <dd class="col-md">{{ $bookingDetails['roomType'] }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Arrival Date</dt>
                                <dd class="col-md">{{ $bookingDetails['arrival'] }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Departure Date</dt>
                                <dd class="col-md">{{ $bookingDetails['departure']}}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Nights</dt>
                                <dd class="col-md">{{ $bookingDetails['night'] }} Night</dd>
                            </dl>

                            <dl class="row">
                                <dt class="col-md">Adults</dt>
                                <dd class="col-md">{{ $bookingDetails['adults'] }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md">Kids</dt>
                                <dd class="col-md">{{ $bookingDetails['children'] }}</dd>
                            </dl>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-md-12 wow fadeInRight" data-wow-delay="0.4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
                <div class="single-sidebar-block booking-form">
                    <h3>Payment Details</h3>
                    <div class="">
                        <p><span class="">Night list</span></p>
                        <div class="table-responsive">
                            <table class="w-100">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th class="text-center">Room</th>
                                        <th class="text-right"><b>Price</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>{{ date('d')}}<br>
                                        </td>
                                        <td class="text-center">1</td>
                                        <td align="right">
                                            {{ hotel_information()->currency_symbol . $bookingDetails['roomRate'] }}
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="3"><b>Total Night Price</b></td>
                                        <td align="right"> <b>
                                                {{ hotel_information()->currency_symbol .  $subTotal = $bookingDetails['roomRate'] * $bookingDetails['night'] }}
                                            </b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="w-100 table-sm">
                                <tbody>
                                    <tr>
                                        <td><b>Discount</b> <small class="text-info">
                                                ( 0 % )

                                            </small></td>
                                        <td class="text-right"><b>

                                                - $
                                                0.00
                                            </b></td>
                                    </tr>
                                    <tr class="border-top">
                                        <td><b>Subtotal</b></td>
                                        <td class="text-right"><b>{{ $subTotal }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p><span class="">Taxes</span></p>
                        <div class="table-responsive">
                            <table class="w-100 table-sm">
                                <tbody>
                                    @foreach (App\Tax::all() as $key=>$tax)
                                    <tr>
                                        <td>{{ $key += 1}}</td>
                                        <td>{{ $tax->name }} <small class="text-info">({{$tax->rate}}.00 %)</small></td>
                                        <td class="text-right">{{ hotel_information()->currency_symbol . $taxTotal[$key] = $subTotal * $tax->rate / 100}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="w-100 table-sm">
                                <tbody>
                                    <tr>
                                        <td><b>Payable Amount</b></td>
                                        <td class="text-right"><b>{{ hotel_information()->currency_symbol . ($subTotal + array_sum($taxTotal))}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" style="padding-top: 24px">
                                <a class="btn btn-primary"
                                    href="#">Confirm Checkout
                                    &gt; &gt; &gt;</a>
                            </div>
                        </div>
                    </div>
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
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: auto;
    }

    dl,
    ol,
    ul {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .col-md {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }

    dt {
        font-weight: 700;
    }

    dd {
        margin-bottom: .5rem;
        margin-left: 0;
    }

    .section-padding {
        padding: 120px 0;
    }

    .pb-60 {
        padding-bottom: 60px;
    }

    .page-sidebar {}


    .single-sidebar-block {
        margin-bottom: 30px;
        box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.1);
    }


    .single-sidebar-block h3 {
        font-size: 22px;
        color: #141414;
        margin-bottom: 15px;
    }

    .price-tag,
    .booking-form {
        padding: 30px 25px;
    }

    .price-tag h4 {
        font-size: 22px;
        color: #141414;
        font-weight: 700;
        margin: 1;
    }

    .price-tag h4 span {
        font-size: 16px;
        font-weight: 400;
    }

    .booking-form {}

    .colorlib-nav #colorlib-logo {
        font-size: 22px;
        margin: 0;
        padding: 0;
        text-transform: uppercase;
        font-weight: 600;
    }

    .w-100 {
        width: 100% !important;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .border-top {
        border-top: 1px solid #dee2e6 !important;
    }

    .badge {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
    }
</style>
{{-- <style>
    .fb-container {
        padding: 0;
    }

    .fb-block-header {
        font-size: 15pt;
    }

    .fb-block-header {
        background-color: #242424;
        font-size: 13pt;
        margin-top: 15px;
        padding: 10px;
    }

    .fb-gray-bg {
        background-color: #f5f5f5;
    }

    .fb-dark-bg,
    #fb-header-toolbar.theme-dark {
        background-color: #242424;
        color: #f5f5f5;
    }

    .fb-block-header .fb-results-acc-title {
        background-color: #242424;
    }

    #fb-recap-hotel {
        border-left: 1px solid #C4C4C4;
        border-right: 1px solid #C4C4C4;
        border-bottom: 1px solid #C4C4C4;
    }

    #fb-recap-hotel div.fb-title {
        font-size: 16pt;
        text-align: left;
    }

    #fb-recap-hotel-details>dl>dt {
        clear: left;
        float: left;
        overflow: hidden;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 160px;
        font-weight: normal;
    }
</style> --}}
@endpush