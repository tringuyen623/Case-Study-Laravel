<?php

namespace App\Http\Controllers\Backend;

use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomTypeImage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $types = RoomType::all();

        // foreach ($types as $type) {
        //     return $type->rates[0]->rate;
        // }
        return view('back_end.room_types.index', ['roomTypes' => RoomType::all()]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('back_end.room_types.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->update($this->validateAttribute());
        $image = request('image');
        $image = base64_encode(file_get_contents($image));
        $image = 'data:image/png;base64,' . $image;
        $roomType->images()->save(new RoomTypeImage(['image' => $image]));

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
        //
    }

    public function validateAttribute(){
        return request()->validate([
            'name' => 'required',
            // 'max_guest' => 'required',
            'description' => 'required'
        ]);
    }
}
