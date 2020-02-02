<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rooms.index', ['rooms' => Room::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create', ['types' => RoomType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAttribute();
        $room = new Room();
        $room->amount = request('amount');
        $room->roomType->name = request('roomType');
        $room->roomType->max_guest = request('maxGuest');
        $room->roomType->description = request('description');

        $room->save();
        $room->roomType->save();

        return redirect(route('rooms.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validateAttribute();
        $room->amount = request('amount');
        $room->roomType->name = request('roomType');
        $room->roomType->max_guest = request('maxGuest');
        $room->roomType->description = request('description');

        $room->save();
        $room->roomType->save();

        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }

    public function validateAttribute(){
        return request()->validate([
            'roomType' => 'required',
            'amount' => 'required',
            'maxGuest' => 'required',
            'description' => 'required'
        ]);
    }
}
