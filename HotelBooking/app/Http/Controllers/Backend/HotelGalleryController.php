<?php

namespace App\Http\Controllers\Backend;

use App\GalleryCategory;
use App\HotelGallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HotelGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $galleries = HotelGallery::all();
        $cates = GalleryCategory::all();

        if (request()->ajax()) {
            return DataTables::of($galleries, $cates)
                ->addColumn('action', function ($galleries) {
                    return '
                <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-primary edit-gallery" data-toggle="modal" data-target="#add-image" data-id ="' . $galleries->id . '"><i
                class="fa fa-edit"></i></button>
                ' .
                        '<button type="button" class="btn btn-outline-primary delete-gallery" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $galleries->id . '"><i
                class="fa fa-trash"></i></button>
                </div>';
                })
                ->editColumn('gallery_category_id', function ($galleries) {
                    return $galleries->galleryCategory->name;
                })
                ->make(true);
        }

        return view('back_end.galleries.gallery', compact('cates'));
    }

    public function store(Request $request)
    {
        $gallery = new HotelGallery();

        $imgUpload = request('image');
        $imgUpload = base64_encode(file_get_contents($imgUpload));
        $imgUpload = 'data:image/png;base64,' . $imgUpload;

        $gallery->image = $imgUpload;
        $gallery->gallery_category_id = request('gallery_category_id');

        $gallery->save();

        return redirect()->route('admin.galleries.index');
    }

    public function show(HotelGallery $hotelGallery)
    {
        //
    }

    public function edit($id)
    {
        $hotelGallery = HotelGallery::findOrFail($id);

        return response()->json($hotelGallery);
    }

    public function update(Request $request, $id)
    {
        $hotelGallery = HotelGallery::findOrFail($id);

        if ($request->hasFile('image')) {
            $imgUpload = request('image');
            $imgUpload = base64_encode(file_get_contents($imgUpload));
            $imgUpload = 'data:image/png;base64,' . $imgUpload;

            $hotelGallery->image = $imgUpload;
            $hotelGallery->gallery_category_id = request('gallery_category_id');

            $hotelGallery->save();

            return redirect()->route('admin.galleries.index');
        } else {
            $hotelGallery->image = $hotelGallery->image;
            $hotelGallery->gallery_category_id = request('gallery_category_id');

            $hotelGallery->save();
            return redirect()->route('admin.galleries.index');
        }
    }

    public function destroy($id)
    {
        HotelGallery::destroy($id);

        return redirect()->route('admin.galleries.index');
    }

    public function getDeletedData()
    {
        $deletedGalleryCategory = HotelGallery::onlyTrashed();

        if (request()->ajax()) {
            return DataTables::of($deletedGalleryCategory)
                ->addColumn('action', function ($deletedGalleryCategory) {
                    return '
            <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary restore-gallery" data-id ="' . $deletedGalleryCategory->id . '"><i
            class="fa fa-undo"></i></button>' .
                        '<button type="button" class="btn btn-outline-primary delete-gallery-category" data-toggle="modal" data-target="#confirmModal" data-id ="' . $deletedGalleryCategory->id . '"><i
            class="fa fa-trash"></i></button>
            </div>';
                })
                ->editColumn('gallery_category_id', function ($galleries) {
                    return $galleries->galleryCategory->name;
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
