<?php

namespace App\Http\Controllers\Backend;

use App\GalleryCategory;
use App\HotelGallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HotelGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = HotelGallery::all();
        $cates = GalleryCategory::all();

        if(request()->ajax()){
            return DataTables::of($galleries, $cates)
            ->addColumn('action', function($galleries){
                return '
                <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-primary edit-gallery" data-toggle="modal" data-target="#add-image" data-id ="' . $galleries->id . '"><i
                class="fa fa-edit"></i></button>
                ' .
                    '<button type="button" class="btn btn-outline-primary delete-gallery" data-toggle="modal" data-target="#confirmModal" data-id ="' . $galleries->id . '"><i
                class="fa fa-trash"></i></button>
                </div>';
            })
            ->make(true);
        }

        return view('back_end.galleries.gallery', compact('cates'));
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
     * @param  \App\HotelGallery  $hotelGallery
     * @return \Illuminate\Http\Response
     */
    public function show(HotelGallery $hotelGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HotelGallery  $hotelGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelGallery $hotelGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HotelGallery  $hotelGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelGallery $hotelGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HotelGallery  $hotelGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelGallery $hotelGallery)
    {
        //
    }

    public function getDeletedData()
    {
        $deletedGalleryCategory = HotelGallery::onlyTrashed();

        if (request()->ajax()) {
            return DataTables::of($deletedGalleryCategory)
                ->addColumn('action', function ($deletedGalleryCategory) {
                    return '
            <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary restore-gallery-category" data-id ="' . $deletedGalleryCategory->id . '"><i
            class="fa fa-undo"></i></button>' .
                        '<button type="button" class="btn btn-outline-primary delete-gallery-category" data-toggle="modal" data-target="#confirmModal" data-id ="' . $deletedGalleryCategory->id . '"><i
            class="fa fa-trash"></i></button>
            </div>';
                })
                ->make(true);
        }

        return view('back_end.galleries.gallery');
    }

    public function restore($id)
    {
        HotelGallery::onlyTrashed()->where('id', '=', $id)->restore();

        return redirect()->route('admin.galleries.index');
    }
}
