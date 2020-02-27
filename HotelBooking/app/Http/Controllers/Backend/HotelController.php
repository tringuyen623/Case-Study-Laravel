<?php

namespace App\Http\Controllers\Backend;

use App\Hotel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    protected $hotel;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $hotel = Hotel::all();

        if(request()->ajax()){
            return DataTables::of($hotel)
            ->addColumn('action', function($hotel){
                return '
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary edit-hotel" data-toggle="modal" data-target="#edit_hotel" data-id ="' . $hotel->id . '"><i
                    class="fa fa-eye"></i></button>';
            })
            ->make(true);
        }
        return view('back_end.hotels.index', compact('hotel'));
    }

    public function edit($id){
        $hotel = Hotel::findOrFail($id);

        return response()->json($hotel);
    }

    public function update($id){
        $hotel = Hotel::findOrFail($id);
        $hotel->update($this->validateAttribute());
        return redirect(route('admin.hotel.index'));
    }

    public function validateAttribute(){
        return request()->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'currency' => 'required|nullable',
            'currency_symbol' => 'required|nullable',
            'check_in_time' => 'required|nullable',
            'check_out_time' => 'required|nullable',

        ]);
    }
}
