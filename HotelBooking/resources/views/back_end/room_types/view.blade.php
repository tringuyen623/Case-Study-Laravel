@extends('back_end.layouts.app')
@section('title',"Room Type Detail")
@push('style')
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<style>
    .img {
        position: relative;
        max-height: 191px;
    }

    .img .non_featured {
        display: none;
    }

    .img .featured {
        display: block;
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 999;
        background: green;
        padding: 5px;
        font-weight: bold;
        color: white;
    }

    .img .delete-img-btn {
        display: none;
        position: absolute;
        bottom: 12px;
        right: 12px;
        z-index: 999;
        padding: 5px;
        font-weight: bold;
        color: white;
    }

    .img:hover>.delete-img-btn {
        display: block;
    }
</style>
@endpush

@section('content')
<div class="content-header">

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary  mb-2" href="{{route('admin.room-types.index')}}"><i class="fa fa-list"></i> Room
                type
                List</a>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4><strong>Room Type Details</strong></h4>
                    <hr />
                    <dl class="row">
                        <dt class="col-md-6">Name :</dt>
                        <dd class="col-md-6">{{$roomType->name}}</dd>
                        <dt class="col-md-6">Short Code :</dt>
                        <dd class="col-md-6">{{$roomType->short_code}}</dd>
                        <dt class="col-md-6">Higher Capacity :</dt>
                        <dd class="col-md-6">{{$roomType->higher_capacity}}</dd>
                        <dt class="col-md-6">Kids Capacity :</dt>
                        <dd class="col-md-6">{{$roomType->kids_capacity}}</dd>
                        <dt class="col-md-6">Amenities :</dt>
                        <dd class="col-md-6">
                            @foreach($roomType->amenities as $amenity)
                            <span class="badge bg-tsk text-white">{{$amenity->name}}</span>
                            @endforeach
                        </dd>
                        <dt class="col-md-6">Base Price :</dt>
                        <dd class="col-md-6">{{number_format($roomType->base_price,2)}}
                            {{hotel_information()->currency}}</dd>
                        <dt class="col-md-6">Status :</dt>
                        <dd class="col-md-6"><span
                                class="badge {{$roomType->status?'badge-success':'badge-danger'}}">{{$roomType->status?'Active':'Inactive'}}</span>
                        </dd>
                    </dl>

                </div>
            </div>
            <div class="card  mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label><strong>Description</strong></label>
                            <hr />
                            {{$roomType->description}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Image</strong>
                    <form action="{{ route('admin.room-types.storeImage')}}" class="float-right" method="post" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="room_type" value="{{$roomType->id}}">
                            <input id="image" type="file" name="image" class="d-none">
                            <label for="image" class="btn btn-sm btn-outline-primary"> <i class="fa fa-folder-open"></i> Add
                                New
                                Image</label>
                            <button type="submit" class="btn  btn-sm btn-primary mb-2"><i class="fa fa-image"></i>
                                Upload</button>
                        </form>
                    </h6>
                    <hr />
                    <div class="row">
                        @foreach($roomType->images as $image)
                        <div class="col-md-6  p-2 ">
                            <div class="img img-thumbnail">
                                <img src="{{ $image->image }}"
                                    class="img-fluid img-responsive">
                                <div class="featured">
                                    @if($image->featured)
                                    FEATURED
                                    @else
                                <a href="{{ route('admin.room-types.setFeatureImage', [$roomType->id, $image->id]) }}"
                                        class="btn btn-sm btn-danger">Set as featured</a>
                                    @endif
                                </div>

                                <div class="delete-img-btn">
                                <form action="{{ route('admin.room-types.deleteImage') }}" method="post" id="delete_img_form_{{$image->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="room_type" value="{{$roomType->id}}">
                                        <input type="hidden" name="id" value="{{$image->id}}">
                                    </form>
                                    <a href="#" onclick="$('#delete_img_form_{{$image->id}}').submit()"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('myscript')
@include('back_end.partials.message')
@endpush