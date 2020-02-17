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

        $rooms = RoomType::whereHas('rooms', function($query){
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
        $rooms = RoomType::whereHas('rooms', function($query){
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
                $arrival =  request('search.arrival');
                $departure =  request('search.departure');
                $query->whereBetween('booking_room.from_date', [$arrival, $departure])
                    ->orWhereBetween('booking_room.to_date', [$arrival, $departure]);
            })->where('is_active', 1)->get();

            $roomAvailable = $roomAvailable->groupBy('room_type_id');

            $search = [
                'arrival' => request('search.arrival'),
                'departure' => request('search.departure'),
                'adults' => request('search.adults'),
                'children' => request('search.children')
            ];
        }

        return view('front_end.room_available', ['rooms' => $roomAvailable, 'search' => $search]);
    }

    public function book($id){
        $room = RoomType::where('status', 1)->findOrFail($id);
        $search = [
            'arrival' => request()->arrival,
            'departure' => request()->departure,
            'adults' => request()->adults,
            'children' => request()->children
        ];
        return view('front_end.booking_form', compact('room', 'search'));
    }

    public function booking($id){
        // $customer = new Customer();
        // $customer->first_name = request('first_name');
        // $customer->last_name = request('last_name');
        // $customer->address = 'Hue';
        // $customer->email = request('email');
        // $customer->phone = request('phone');
        // $customer->gender = request('gender');
        // $customer->save();

        // $booking = new Booking();
        // $booking->customer_id = $customer->id;
        // $booking->no_of_guests = request('adults') + request('children');
        // $booking->save();

        // $date_in =  request('arrival');
        // $date_out = request('departure');

        // $roomId = RoomType::findOrFail($id)->rooms->first()->id;
        // $booking->rooms()->attach(
        //     $booking->id,
        //     [
        //         'room_id' => $roomId,
        //         'from_date' => $date_in,
        //         'to_date' => $date_out
        //     ]
        // );

        $cusDetails = [
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender')
        ];

        $bookingDetails = [
            'arrival' => request('arrival'),
            'departure' => request('departure'),
            'roomType' => RoomType::findOrFail($id)->name,
        ];

        return view('front_end.checkout', compact('cusDetails', 'bookingDetails'));
    }

    public function checkout(){

    }
}
