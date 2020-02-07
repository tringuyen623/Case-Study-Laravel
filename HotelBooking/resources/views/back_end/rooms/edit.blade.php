@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ route('rooms.update', $room->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleFormControlInput1">View</label>
                            <input name="view" type="text" class="form-control" id="exampleFormControlInput1"
                                value="{{ $room->view }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Size</label>
                            <input name="size" type="text" class="form-control" id="exampleFormControlInput1"
                                value="{{ $room->size }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Room Type</label>
                            <select name="room_type_id" id="roomtype">
                                @foreach ($types as $type)
                                <option value="{{$type->id}}" 
                                    @if ($type->id === old('room_type_id',
                                    $room->room_type_id))
                                    selected="selected"
                                    @endif
                                    >{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Bed</label>
                            <select name="bed_id" id="roomtype">
                                @foreach ($beds as $bed)
                                <option value="{{$bed->id}}" 
                                    @if ($bed->id === old('bed_id',
                                    $room->bed_id))
                                    selected="selected"
                                    @endif
                                    >{{$bed->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection