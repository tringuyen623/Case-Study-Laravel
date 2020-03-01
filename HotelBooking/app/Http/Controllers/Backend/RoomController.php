<?php

namespace App\Http\Controllers\Backend;

use App\Bed;
use App\Hotel;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('back_end.rooms.index');
    }

    public function getData()
    {
        $rooms = Room::latest();

        if (request()->ajax()) {
            return DataTables::of($rooms)
                ->addColumn('action', function ($rooms) {

                    return '
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary edit-room" data-toggle="modal" data-target="#add-room" data-id ="' . $rooms->id . '"><i
                    class="fa fa-edit"></i></button>'
                ;
                })
                ->editColumn('room_type_id', function($rooms){
                    return $rooms->roomType->name;
                })
                ->editColumn('bed_id', function($bed){
                    return $bed->bed->bed_type;
                })
                ->editColumn('extra_bed', function($bed){
                    return $bed->extra_bed === 1 ? 'Yes' : 'No';
                })
                ->editColumn('is_active', function($rooms){
                        return $rooms->is_active === 1 ? 'Active' : 'Inactive';
                })
                ->make(true);
        }
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
    public function store()
    {
        Room::create($this->validateAttribute());

        return redirect(route('admin.rooms.index'));
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
        return response()->json($room);
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
            'room_number' => 'required',
            'view' => 'required',
            'room_type_id' => 'required',
            'bed_id' => 'required',
            'extra_bed' => 'required',
            'is_active' => 'required'
        ]);
    }
}
