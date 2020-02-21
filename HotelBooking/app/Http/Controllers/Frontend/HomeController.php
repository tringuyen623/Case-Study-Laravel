<?php

namespace App\Http\Controllers\Frontend;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Room;
use App\RoomType;
use App\Customer;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {
        $search = [
            'arrival' => '',
            'departure' => '',
            'adults' => '',
            'children' => '',
        ];

        $rooms = RoomType::whereHas('rooms', function ($query) {
            $query->where('is_active', 1);
        })->where('status', 1)->get();

        return view('front_end.home', compact('rooms', 'search'));
    }

    public function hotel()
    {
        return $hotel = Hotel::first();
    }

    public function roomList()
    {
        $rooms = RoomType::whereHas('rooms', function ($query) {
            $query->where('is_active', 1);
        })->where('status', 1)->get();

        $search = [
            'arrival' => '',
            'departure' => '',
            'adults' => '',
            'children' => '',
        ];

        return view('front_end.rooms', compact('rooms', 'search'));
    }

    public function checkAvailable()
    {
        $search = [
            'arrival' => '',
            'departure' => '',
            'adults' => '',
            'children' => '',
        ];

        if (request('search')) {
            $roomAvailable = Room::whereDoesntHave('bookings', function (Builder $query) {
                $arrival = date('Y-m-d', strtotime(request('search.arrival')));
                $departure =  date('Y-m-d', strtotime(request('search.departure')));
                $query->where('booking_room.from_date', '>=', $arrival)
                    ->where('booking_room.from_date', '<=', $departure)
                    ->where('booking_room.to_date', '>=', $arrival)
                    ->where('booking_room.to_date', '<=', $departure);
                // ->orWhereBetween('booking_room.to_date', [$arrival, $departure]);
            })->where('is_active', 1)->get();

            $roomAvailable = $roomAvailable->groupBy('room_type_id');

            $search = [
                'arrival' => request('search.arrival'),
                'departure' => request('search.departure'),
                'adults' => request('search.adults'),
                'children' => request('search.children')
            ];
        }

        // return request('search.arrival') ;
        // return $roomAvailable;

        return view('front_end.room_available', ['rooms' => $roomAvailable, 'search' => $search]);
    }

    public function book($id)
    {
        $room = Room::where('is_active', 1)->findOrFail($id);
        // $roomType = RoomType::where('status', 1)->findOrFail($room->room)
        $search = [
            'arrival' => request()->arrival,
            'departure' => request()->departure,
            'adults' => request()->adults,
            'children' => request()->children
        ];
        // return $room->rooms;
        return view('front_end.booking_form', compact('room', 'search'));
    }

    public function booking()
    {
        // return 'chi do';
        $cusDetails = [
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender')
        ];
        $date_in = strtotime(request('arrival'));
        $date_out = strtotime(request('departure'));
        $timeDiff = abs($date_in - $date_out);
        $numberOfNights = $timeDiff / 86400;

        $roomType = Room::findOrFail(request('room_id'))->roomType;

        $bookingDetails = [
            'arrival' => request('arrival'),
            'departure' => request('departure'),
            'adults' => request('adults'),
            'children' => request('children'),
            'roomType' => $roomType->name,
            'roomRate' => $roomType->base_price,
            'night' => $numberOfNights
        ];

        // return $cusDetails['first_name'];

        $customer = new Customer();
        $customer->first_name = $cusDetails['first_name'];
        $customer->last_name = $cusDetails['last_name'];
        $customer->email = $cusDetails['email'];
        $customer->phone = $cusDetails['phone'];
        $customer->gender = $cusDetails['gender'];
        $customer->save();

        $booking = new Booking();
        $booking->customer_id = $customer->id;
        $booking->no_of_guests = request('adults') + request('children');
        $booking->save();


        $roomId = request('room_id');
        $booking->rooms()->attach(
            $booking->id,
            [
                'room_id' => $roomId,
                'from_date' => request('arrival'),
                'to_date' => request('departure')
            ]
        );

        return view('front_end.checkout', compact('cusDetails', 'bookingDetails', 'booking'));
    }

    public function checkout()
    {
        $cusDetails = [
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender')
        ];
        $date1 = strtotime(request('arrival'));
        $date2 = strtotime(request('departure'));
        $timeDiff = abs($date2 - $date1);
        $numberOfNights = $timeDiff / 86400;

        $bookingDetails = [
            'arrival' => request('arrival'),
            'departure' => request('departure'),
            'adults' => request('adults'),
            'children' => request('children'),
            'roomType' => RoomType::findOrFail(request('room_type_id'))->name,
            'night' => $numberOfNights
        ];

        return view('front_end.checkout', compact('cusDetails', 'bookingDetails'));
    }
}
