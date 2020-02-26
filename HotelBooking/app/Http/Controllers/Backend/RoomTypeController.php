<?php

namespace App\Http\Controllers\Backend;

use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomTypeImage;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class RoomTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $types = RoomType::all();

        return view('back_end.room_types.index', compact('types'));
    }

    public function getData()
    {
        $roomType = RoomType::all();

        if (request()->ajax()) {
            return DataTables::of($roomType)
                ->addColumn('action', function ($roomType) {

                    return '
                    <div class="btn-group btn-group-sm">
                    <a href="' . route('admin.room-types.show', $roomType->id) . '" class="btn btn-outline-primary"><i class="fa fa-eye"></i> </a>
                    <button type="button" class="btn btn-outline-primary edit-room-type" data-toggle="modal" data-target="#add_room_type" data-id ="' . $roomType->id . '"><i
                    class="fa fa-edit"></i></button>
                    ' .
                        '<button type="button" class="btn btn-outline-primary delete-room-type" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $roomType->id . '"><i
                    class="fa fa-trash"></i></button>
                    </div>';
                })
                ->addColumn('Total Rooms', function ($roomType) {
                    return $roomType->rooms->count();
                })
                ->make(true);
        }
    }

    public function getDeletedData()
    {
        $deletedRoomType = RoomType::onlyTrashed();

        if (request()->ajax()) {
            return DataTables::of($deletedRoomType)
                ->addColumn('action', function ($deletedRoomType) {
                    return '
            <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary restore-room-type" data-id ="' . $deletedRoomType->id . '"><i
            class="fa fa-undo"></i></button>' .
                        '<button type="button" class="btn btn-outline-primary force-delete" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $deletedRoomType->id . '"><i
            class="fa fa-trash"></i></button>
            </div>';
                })
                ->addColumn('Total Rooms', function ($roomType) {
                    return $roomType->rooms->count();
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
        return view('back_end.room_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        RoomType::create($this->validateAttribute());

        return redirect(route('admin.room-types.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomType = RoomType::findOrFail($id);

        return view('back_end.room_types.view', compact('roomType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);

        return response()->json($roomType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->update($this->validateAttribute());

        return redirect(route('admin.room-types.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request('delete-action') === 'SoftDelete') {
            RoomType::destroy($id);
        } else {
            RoomType::onlyTrashed()->where('id', $id)->forceDelete();
        }

        return redirect()->route('admin.room-types.index');
    }

    public function restore($id)
    {
        RoomType::onlyTrashed()->where('id', '=', $id)->restore();

        return redirect()->route('admin.room-types.index');
    }

    public function uploadImage()
    {

        $imgUpload = request('image');
        $imgUpload = base64_encode(file_get_contents($imgUpload));
        $imgUpload = 'data:image/png;base64,' . $imgUpload;

        $featured = RoomTypeImage::where('featured', 1)->where('room_type_id', request('room_type'))->first();

        if ($featured && request('featured')) {
            $featured->featured = 0;
            $featured->save();
        }

        $roomTypeImage = new RoomTypeImage();

        $roomTypeImage->image = $imgUpload;
        $roomTypeImage->room_type_id = request('room_type');
        $roomTypeImage->featured = request('featured') ? 1 : 0;
        $roomTypeImage->save();

        return redirect()->back()->with('success', 'Upload successful');
    }

    public function setFeatureImage($roomTypeId, $imageId)
    {
        if ($featuredImage = RoomTypeImage::where('featured', 1)->where('room_type_id', $roomTypeId)->first()) {
            $featuredImage->featured = 0;
            $featuredImage->save();
        }

        $roomTypeImage = RoomTypeImage::findOrFail($imageId);
        $roomTypeImage->featured = 1;
        $roomTypeImage->save();

        return redirect()->back()->with('success', 'Upload successful');
    }

    public function deleteImage()
    {
        RoomTypeImage::destroy(request('id'));

        return redirect()->back()->with('success', 'Delete successful');
    }

    public function validateAttribute()
    {
        return request()->validate([
            'name' => 'required',
            'short_code' => 'required',
            'higher_capacity' => 'nullable|required',
            'kids_capacity' => 'nullable|required',
            'base_price' => 'nullable|required',
            'description' => 'required',
            'status' => 'required'
        ]);
    }
}
