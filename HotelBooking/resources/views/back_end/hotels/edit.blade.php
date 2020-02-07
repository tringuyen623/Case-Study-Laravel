@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ route('hotels.update', $hotel->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Hotel Name</label>
                            <input name="name" type="text" class="form-control" id="exampleFormControlInput1"
                                value="{{ $hotel->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Address</label>
                            <textarea name="address" class="form-control" id="exampleFormControlTextarea1"
                                rows="5">{{ $hotel->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input name="phone" type="text" class="form-control" id="exampleFormControlInput1"
                                value="{{ $hotel->phone }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection