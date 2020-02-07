@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @foreach ($rooms as $room)
                    <p><strong>Type:</strong> {{ $room->roomType->name }}</p>
                    <p>MaxGuest: {{ $room->roomType->max_guest }}</p>
                    <p><strong>Desc:</strong> {{ $room->roomType->description }}</p>
                    <p><strong>Type of bed:</strong> {{ $room->bed->type }}</p>
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add</a>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('types.edit', $room->roomType->id) }}" class="btn btn-warning">Edit Type</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection