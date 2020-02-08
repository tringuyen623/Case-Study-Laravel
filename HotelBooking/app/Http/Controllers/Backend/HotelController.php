<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $hotel = Hotel::first();
        // return count($hotel->rooms);
        return view('hotels.index', ['hotels' => Hotel::all()]);
    }

    public function edit($id){
        $hotel = Hotel::findOrFail($id);
        return view('hotels.edit', compact('hotel'));
    }

    public function update($id){
        $hotel = Hotel::findOrFail($id);
        $hotel->update($this->validateAttribute());
        return redirect(route('hotels.index'));
    }

    public function validateAttribute(){
        return request()->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
    }
}
