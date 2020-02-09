<?php

namespace App\Http\Controllers\Frontend;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $hotel = Hotel::first();

        return View::share('hotel', $hotel);
    }

    public function index(){
        
        return view('front_end.home', ['rooms' => Room::all()]);
    }

    public function hotel(){
        return $hotel = Hotel::first();
    }
}
