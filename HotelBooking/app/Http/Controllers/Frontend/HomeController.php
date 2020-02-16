<?php

namespace App\Http\Controllers\Frontend;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Room;
use App\RoomType;
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
}
