<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Hotel;

class RoomController extends Controller
{
    public function index(){
        return view('front_end.rooms', ['rooms' => Room::all()]);
    }
}
