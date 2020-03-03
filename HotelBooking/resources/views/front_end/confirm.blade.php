@extends('front_end.layouts.app')
@section('title','Booking Complete')
@section('content')
<!--Room Details Area-->
<section class="room-details-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 d-print-none">
                <h1 class="text-success text-center">Congratulations your booking request complete.</h1>
            </div>
            <div class="col-lg-12 col-md-12 wow fadeInLeft" data-wow-delay="0.4s">
                <div class="page-sidebar">
                    <div class="single-sidebar-block booking-form mb-5 pb-5">
                        <h3>Your Booking Details <div class="btn btn-fill float-right"
                                onclick="Javascript:window.print()"><i class="fa fa-print"></i> </div>
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Booking No</th>
                                    <td>{{ Session::get('booking')->id }}</td>
                                </tr>
                                <tr>
                                    <th>Room Type</th>

                                    <td>
                                        @foreach (Session::get('booking')->rooms as $room)
                                        <li>{{ $room->roomType->name }} </li>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Arrival Date</th>
                                    <td>{{ Session::get('booking')->getCheckInday()}}</td>
                                </tr>
                                <tr>
                                    <th>Departure Date</th>
                                    <td>{{Session::get('booking')->getCheckOutday()}}</td>
                                </tr>
                                <tr>
                                    <th>Nights</th>
                                    <td>{{ Session::get('totalNight') }} Night</td>
                                </tr>
                                <tr>
                                    <th>Adults</th>
                                    <td>{{ array_sum(Session::get('search')['adults']) }}</td>
                                </tr>
                                <tr>
                                    <th>Kids</th>
                                    <td>{{ array_sum(Session::get('search')['children']) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Room Charge</th>
                                    <td>{{ hotel_information()->currency_symbol . number_format(Session::get('booking')->getTotalRate(),2) }} </td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td><span class="badge badge-success">{{Session::get('booking')->paid->payment_status_id ? 'Paid' : 'Due'}}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--/Listing Details Area-->

@endsection