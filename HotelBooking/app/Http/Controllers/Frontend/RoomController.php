<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Hotel;
use Illuminate\Database\Eloquent\Builder;

class RoomController extends Controller
{
    public function index()
    {
        $search = [
            'arrival' => '',
            'departure' => '',
            'adults' => '',
            'children' => '',
        ];

        return view('front_end.rooms', ['rooms' => Room::all(), 'search' => $search]);
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
            $ava = Room::whereDoesntHave('bookings', function (Builder $query) {
                $date_in =  request('search[arrival]');
                $date_out =  request('search[departure]');
                $query->whereBetween('booking_room.from_date', [$date_in, $date_out])
                    ->orWhereBetween('booking_room.to_date', [$date_in, $date_out]);
            })->get();

            $search = [
                'arrival' => request('search[arrival]'),
                'departure' => request('search[departure]'),
                'adults' => request('search[adults]'),
                'children' => request('search[children]'),
            ];
        }
        dd($search);
        return view('front_end.rooms', ['rooms' => Room::all(), 'search' => $search]);
    }
}
