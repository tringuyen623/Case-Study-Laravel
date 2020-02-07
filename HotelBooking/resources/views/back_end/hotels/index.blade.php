@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @foreach ($hotels as $hotel)
                    <h1>{{ $hotel->name }}</h1>
                    <p>Address: <strong>{{ $hotel->address }} </strong></p>
                    <p>Telephone: {{ $hotel->phone }} </p>
                    <p>Total Rooms: {{ count($hotel->rooms) }}</p>
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection