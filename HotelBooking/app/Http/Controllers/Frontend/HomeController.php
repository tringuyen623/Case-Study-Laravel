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
    public function index(){
        $search = [
            'arrival' => '',
            'departure' => '',
            'adults' => '',
            'children' => '',
        ];
        
        return view('front_end.home', ['roomTypes' => RoomType::all(), 'search'=> $search]);
    }

    public function hotel(){
        return $hotel = Hotel::first();
    }

    public function checkAvailable(Request $request)
    {
        $search = [
            'arrival' => '',
            'departure' => '',
            'adults' => '',
            'children' => '',
        ];

        if (request('search')) {
            $ava = Room::whereDoesntHave('bookings', function (Builder $query) {
                $date_in =  request('search[arrival]');
                $date_out =  request('search[departure]');
                $query->whereBetween('booking_room.from_date', [$date_in, $date_out])
                    ->orWhereBetween('booking_room.to_date', [$date_in, $date_out]);
            })->get();

            $ava = $ava->groupBy('room_type_id');
            // $ava = $ava->roomType();
            // $ava = $ava->all();
            // return $ava;
            $search = [
                'arrival' => $request->search['arrival'],
                'departure' => $request->search['departure'],
                'adults' => $request->search['adults'],
                'children' => $request->search['children'],
            ];
        }
        return view('front_end.rooms', ['rooms' => $ava, 'search' => $search]);
    }
}
