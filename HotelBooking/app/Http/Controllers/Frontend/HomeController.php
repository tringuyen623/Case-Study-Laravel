<?php

namespace App\Http\Controllers\Frontend;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Room;
use App\RoomType;
use App\Customer;
use App\Booking;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if(session()->has(['search','roomId', 'booking']) || session()->has('booking')){
            session()->forget(['search', 'roomId', 'booking']);
        }

        $search = [
            'arrival' => '',
            'departure' => '',
            'rooms' => [1],
            'adults' => [1],
            'children' => [0],
        ];

        $rooms = RoomType::whereHas('rooms', function ($query) {
            $query->where('is_active', 1);
        })->where('status', 1)->get();

        session()->put('search', $search);
        return view('front_end.home', compact('rooms', 'search'));
    }

    public function roomList()
    {
        $rooms = RoomType::whereHas('rooms', function ($query) {
            $query->where('is_active', 1);
        })->where('status', 1)->get();

        $search= session()->get('search');

        return view('front_end.rooms', compact('rooms', 'search'));
    }

    public function roomDetails($id){
        $roomType = RoomType::findOrFail($id);

        return view('front_end.room_details', compact('roomType'));
    }

    public function checkAvailable(Request $request)
    {
        if (request('search')) {
            session()->forget('search');

            $this->validateSearch();

            $search_data = collect([
                'arrival' => request('search.arrival'),
                'departure' => request('search.departure'),
                'rooms' => request('search.rooms'),
                'adults' => request('search.adults'),
                'children' => request('search.children')
            ]);

            session()->put('search', $search_data);

            $roomAvailable = Room::whereDoesntHave('bookings', function (Builder $query) {
                $arrival = date('Y-m-d', strtotime(request('search.arrival')));
                $departure =  date('Y-m-d', strtotime(request('search.departure')));
                $query->where('booking_room.from_date', '>=', $arrival)
                    ->orWhere('booking_room.from_date', '<=', $departure)
                    ->where('booking_room.to_date', '>=', $arrival)
                    ->orWhere('booking_room.to_date', '<=', $departure);
            })->where('is_active', 1)->get();

            $numberOfRooms = $roomAvailable->count();
            
            if($numberOfRooms < count(request('search.rooms'))){
                return view('front_end.room_available', ['rooms' => []]);
            };

            
            $roomAvailable = $roomAvailable->groupBy('room_type_id');            
        }

        return view('front_end.room_available', ['rooms' => $roomAvailable]);
    }

    public function booking()
    {        
        $this->validatePayment();

        $date_in = session()->get('search')['arrival'];
        $date_out = session()->get('search')['departure'];
        $adults = session()->get('search')['adults'];
        $children = session()->get('search')['children'];
       
        $customer = Customer::create($this->validateCustomerInfo());

        if($customer){
            $booking = new Booking();
            $booking->customer_id = $customer->id;
            $booking->no_of_guests = array_sum($adults) + array_sum($children);
            $booking->save();
    
    
            $roomId = session()->get('roomId');
            foreach($roomId as $id){
                $booking->rooms()->attach(
                    $booking->id,
                    [
                        'room_id' => $id,
                        'from_date' => $date_in,
                        'to_date' => $date_out
                    ]
                );
            }

            if($booking){
                $booking->paid()->create(['booking_id' => $booking->id, 'payment_status_id' => 1, 'payment_type_id' => 1, 'amount' => $booking->getTotalRate(), 'date' => now()->format('Y-m-d')]);
            }
            
            session()->put('booking', $booking);

        }
        
        return redirect()->route('checkout');
    }

    public function payment()
    {
        
        $date1 = strtotime(Session::get('search')['arrival']);
        $date2 = strtotime(Session::get('search')['departure']);
        $timeDiff = abs($date2 - $date1);
        $numberOfNights = $timeDiff / 86400;

        $roomId = request('roomId');
        session()->put(['roomId' => $roomId, 'totalNight' => $numberOfNights]);
        
        $roomCharge = request('total-room-charge');
        
        return view('front_end.payment', compact('numberOfNights', 'roomCharge'));
    }

    public function checkout(){
        return view('front_end.confirm');
    }

    public function validateSearch(){
        return request()->validate([
            'search.arrival' => 'required',
            'search.departure' => 'required'
        ]);
    }

    public function validateCustomerInfo(){
        return request()->validate([
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email'
        ]);
    }

    public function validatePayment(){
        return request()->validate([
            'cardname' => 'required',
            'cardnumber' => 'required|numeric',
            'expmonth' => 'date_format:m|size:2',
            'expyear' => 'date_format:Y|size:4',
            'cvv' => 'required|regex:/[0-9]$/|size:3'
        ]);
    }
}
