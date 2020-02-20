<?php

namespace App\Http\Controllers\Backend;

use App\GalleryCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class GalleryCategoryController extends Controller
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
        $galleryCategory = GalleryCategory::all();

        if (request()->ajax()) {
            return DataTables::of($galleryCategory)
                ->addColumn('action', function ($galleryCategory) {

                    return '
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary edit-gallery-category" data-toggle="modal" data-target="#add_category" data-id ="' . $galleryCategory->id . '"><i
                    class="fa fa-edit"></i></button>
                    ' .
                        '<button type="button" class="btn btn-outline-primary delete-gallery-category" data-toggle="modal" data-target="#confirmModal" data-id ="' . $galleryCategory->id . '"><i
                    class="fa fa-trash"></i></button>
                    </div>';
                })
                ->make(true);
        }

        return view('back_end.galleries.categories');
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
        GalleryCategory::create($this->validateAttribute());

        return redirect()->route('admin.gallery-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryCategory $galleryCategory)
    {
        return response()->json($galleryCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $galleryCategory->update($this->validateAttribute());

        return redirect()->route('admin.gallery-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryCategory $galleryCategory)
    {
        GalleryCategory::destroy($galleryCategory->id);

        return redirect()->route('admin.gallery-categories.index');
    }

    public function getDeletedData()
    {
        $deletedGalleryCategory = GalleryCategory::onlyTrashed();

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
    }

    public function restore($id)
    {
        GalleryCategory::onlyTrashed()->where('id', '=', $id)->restore();

        return redirect()->route('admin.gallery-categories.index');
    }

    public function validateAttribute()
    {
        return request()->validate([
            'name' => 'required'
        ]);
    }
}
