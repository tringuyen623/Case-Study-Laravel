@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Room Type</label>
                            <select name="room_type_id" id="roomtype">
                                @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Bed</label>
                            <select name="bed_id" id="roomtype">
                                @foreach ($beds as $bed)
                                <option value="{{$bed->id}}">{{$bed->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">View</label>
                            <input name="view" type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="view">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Size</label>
                            <input name="size" type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="size">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection