<?php

namespace App\Http\Controllers\Backend;

use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomTypeImage;
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

        // $types = RoomType::all();

        // foreach ($types as $type) {
        //     return $type->rates[0]->rate;
        // }
        // return response()->json(['data' => RoomType::all()]);
        // if(request(aj)
        return view('back_end.room_types.index');
        
    }

    public function getData(){
        if(request()->ajax()){
            return DataTables::of(RoomType::all())->make(true);
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
            'short_code' => 'required',
            'higher_capacity' => 'nullable|required',
            'kids_capacity' => 'nullable|required',
            'base_price' => 'nullable|required',
            'description' => 'required',
            'status' => 'required'
        ]);
    }
}
