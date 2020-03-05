<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
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
        $data['date'] = request('date') ? Carbon::parse(request('date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $data['current_booking'] = Booking::whereHas('rooms', function($detail){
            $detail->where('from_date', '<=', Carbon::now()->format('Y-m-d'))->where('to_date', '>', Carbon::now()->format('Y-m-d'));
        })->whereNull('deleted_at')->get();

        $data['upcoming_booking'] = Booking::whereHas('rooms', function($detail){
            $detail->where('from_date', '<=', Carbon::now()->format('Y-m-d'))->where('to_date', '>', Carbon::now()->format('Y-m-d'));
        })->where('status', 1)->get();
        
        $totalChart = $this->chartData();

        return view('back_end.index', compact('rooms', 'bookings', 'data', 'totalChart'));
    }

    public function chartData(){
        $subscribe = Booking::whereYear('created_at', '=', date('Y'))->where('status', 1)->get()->groupBy(function($year){
            return $year->created_at->format('F');
        });

        $monthlyChart = collect([]);

        foreach(month_arr() as $key => $value){
            $monthlyChart->push([
                'month' => Carbon::parse(date('Y').'-'.$key)->format('Y-m'),
                'booking' => $subscribe->has($value) ? $subscribe[$value]->whereNull('deleted_at')->count() : 0
            ]);
        }

        return response()->json($monthlyChart->toArray())->content();
    }
}
