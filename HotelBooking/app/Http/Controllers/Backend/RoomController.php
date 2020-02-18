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
        return view('back_end.rooms.index', ['types' => RoomType::all()]);
    }

    public function getData()
    {
        $rooms = Room::all();

        if (request()->ajax()) {
            return DataTables::of($rooms)
                ->addColumn('action', function ($rooms) {

                    return '
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary edit-room" data-toggle="modal" data-target="#add_room" data-id ="' . $rooms->id . '"><i
                    class="fa fa-edit"></i></button>'
                ;
                })
                ->editColumn('room_type_id', function($rooms){
                    return $rooms->roomType->name;
                })
                ->editColumn('is_active', function($rooms){
                    if ($rooms->is_active === 1){
                        return 'Active';
                    }else {
                        return 'Inactive';
                    }
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
        $room->room_type_id = request('room_type_id');
        $room->bed_id = 1;
        $room->view = request('view');
        $room->size = request('size');
        $room->is_active = request('is_active');

        if($room->save()){
            return $room;
        }

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
        // return request('my-checkbox');
        $room->room_type_id = request('room_type_id');
        $room->bed_id = 1;
        $room->view = request('view');
        $room->size = request('size');
        $room->is_active = request('is_active');
        $room->update();

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
            // 'bed_id' => 'required'
        ]);
    }
}
