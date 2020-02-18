<?php

namespace App\Http\Controllers\Backend;

use App\Amenity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AmenityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $amenities = Amenity::all();

        // return $amenities;
        if(request()->ajax()){
            return DataTables::of($amenities)
            ->addColumn('action', function($amenities){
                return '
                <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-primary edit-amenity" data-toggle="modal" data-target="#add_amenity" data-id ="' . $amenities->id . '"><i
                class="fa fa-edit"></i></button>' .
                '<button type="button" class="btn btn-outline-primary delete-amenity" data-toggle="modal" data-target="#add_amenity" data-id ="' . $amenities->id . '"><i
                class="fa fa-trash"></i></button>
                </div>';
            })
            ->make(true);
        }

        return view('back_end.amenity.index');
    }

    public function store(){
        Amenity::create($this->validateAttribute());

        return redirect(route('admin.amenities.index'));
    }

    public function validateAttribute(){
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
    }

    public function edit($id){
        $amenity = Amenity::findOrFail($id);

        return response()->json($amenity);
    }
}
