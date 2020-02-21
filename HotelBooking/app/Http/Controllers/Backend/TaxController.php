<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $taxes = Tax::all();

        if (request()->ajax()) {
            return DataTables::of($taxes)
                ->addColumn('action', function ($taxes) {
                    return '
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary view-room-type" data-toggle="modal" data-target="#add-tax" data-id ="' . $taxes->id . '"><i
                    class="fa fa-eye"></i></button>' .
                        '<button type="button" class="btn btn-outline-primary edit-tax" data-toggle="modal" data-target="#add-tax" data-id ="' . $taxes->id . '"><i
                    class="fa fa-edit"></i></button>
                    ' .
                        '<button type="button" class="btn btn-outline-primary delete-tax" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $taxes->id . '"><i
                    class="fa fa-trash"></i></button>
                    </div>';
                })
                ->make(true);
        }
        
        return view('back_end.hotels.tax', compact('taxes'));
    }

    public function store(Request $request)
    {
        Tax::create($this->validateAttribute());


        return redirect()->route('admin.taxes.index');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $tax = Tax::findOrFail($id);

        return response()->json($tax);
    }

    public function update($id)
    {
        $tax = Tax::findOrFail($id);

        $tax->update($this->validateAttribute());

        return redirect()->route('admin.taxes.index');
    }

    public function destroy($id)
    {
        Tax::destroy($id);

        return redirect()->route('admin.galleries.index');
    }

    public function getDeletedData()
    {
        $deleteTax = Tax::onlyTrashed();

        if (request()->ajax()) {
            return DataTables::of($deleteTax)
                ->addColumn('action', function ($deleteTax) {
                    return '
            <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary restore-tax" data-id ="' . $deleteTax->id . '"><i
            class="fa fa-undo"></i></button>' .
                        '<button type="button" class="btn btn-outline-primary delete-tax" data-toggle="modal" data-target="#confirm-modal" data-id ="' . $deleteTax->id . '"><i
            class="fa fa-trash"></i></button>
            </div>';
                })
                ->make(true);
        }

        return view('back_end.galleries.gallery');
    }

    public function restore($id)
    {
        Tax::onlyTrashed()->where('id', '=', $id)->restore();

        return redirect()->route('admin.galleries.index');
    }

    public function validateAttribute(){
        return request()->validate([
            'name' => 'required',
            'type' => 'required',
            'rate' => 'required',
            'status' => 'required'
        ]);
    }
}
