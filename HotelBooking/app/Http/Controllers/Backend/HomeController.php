<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $rooms;
    protected $booking;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rooms = Room::all();
        $this->booking = Booking::all();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rooms = $this->rooms;
        $bookings = $this->booking;
        
        return view('back_end.index', compact('rooms', 'bookings'));
    }
}
