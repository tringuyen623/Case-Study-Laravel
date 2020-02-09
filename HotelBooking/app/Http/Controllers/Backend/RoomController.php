<?php

namespace App\Http\Controllers\Backend;

use App\Bed;
use App\Hotel;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back_end.rooms.index', ['rooms' => Room::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create', ['types' => RoomType::all(), 'hotel' => Hotel::all(), 'beds' => Bed::all()]);
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
        $room->hotel_id = 1;
        $room->room_type_id = request('room_type_id');
        $room->bed_id = 1;
        $room->view = request('view');
        $room->size = request('size');

        $room->save();

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
        $types = RoomType::all();
        $beds = Bed::all();
        return view('back_end.rooms.edit', compact(['room', 'types', 'beds']));
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
        // return request('my-checkbox');
        $room->update($this->validateAttribute());

        return redirect(route('admin.rooms.index'));
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
            'view' => 'required',
            'size' => 'required',
            'room_type_id' => 'required',
            'bed_id' => 'required'
        ]);
    }
}
