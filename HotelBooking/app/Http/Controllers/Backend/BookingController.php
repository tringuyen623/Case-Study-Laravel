<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->first_name = 'Mr.Test';
        $customer->last_name = 'Book Hotel';
        $customer->address = 'Hue';
        $customer->email = 'tri@gmail.com';
        $customer->phone = '123456';
        $customer->gender = 1;
        $customer->save();

        $booking = new Booking();
        $booking->customer_id = $customer->id;
        $booking->no_of_guests = request('no_of_guest');
        $booking->save();

        $date_in =  date('Y-m-d', strtotime(request('date_in')));
        $date_out =  date('Y-m-d', strtotime(request('date_out')));

        $booking->rooms()->attach(
            $booking->id,
            [
                'room_id' => 1,
                'from_date' => $date_in,
                'to_date' => $date_out
            ]
        );

        return $booking;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function check()
    {
        // $booking  = Booking::all();

        // return $booking;
        // $booking->rooms;
        // foreach($booking as $book){


        $ava = Room::whereDoesntHave('bookings', function (Builder $query) {
            $date_in =  date('Y-m-d', strtotime(request('date_in')));
            $date_out =  date('Y-m-d', strtotime(request('date_out')));
            $query->whereBetween('booking_room.from_date', [$date_in, $date_out])
                ->orWhereBetween('booking_room.to_date', [$date_in, $date_out]);
        })->get();
        return $ava;
        // print_r($ava);
        // }
    }
    public function search($id)
    {
        return Booking::findOrFail($id)->rooms;
    }
}
