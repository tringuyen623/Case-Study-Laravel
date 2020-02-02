@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('hotels.index') }}" class="btn btn-primary">Hotel Management</a>
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Room Management</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
