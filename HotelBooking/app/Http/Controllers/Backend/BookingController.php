<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Booking;
use App\Customer;
use App\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();

        if (request()->ajax()) {
            return DataTables::of($bookings)
                ->addColumn('action', function ($bookings) {
                    return '
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-danger cancel-booking" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $bookings->id . '"><i
                    class="fa fa-window-close"></i></button>';
                })
                ->editColumn('customer_id', function($canceled){
                    return $canceled->customer->first_name;
                })
                ->editColumn('base_price', function($canceled){
                    $base_price = [];
                    foreach($canceled->rooms as $room){
                        $base_price[] = $room->roomType->base_price;
                    }
                    return $base_price;

                    
                })
                ->make(true);
        }

        return view('back_end.bookings.index', compact('bookings'));
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
        Booking::destroy($booking->id);

        return redirect()->route('admin.bookings.index');
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

    public function getDeletedData()
    {
        $canceled = Booking::onlyTrashed();

        if (request()->ajax()) {
            return DataTables::of($canceled)
                ->addColumn('action', function ($canceled) {
                    return '
            <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary delete-booking" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $canceled->id . '">
            <i class="fa fa-trash"></i></button>
            </div>';
                })
                ->editColumn('customer_id', function($canceled){
                    return $canceled->customer->first_name;
                })
                ->make(true);
        }
    }
}
