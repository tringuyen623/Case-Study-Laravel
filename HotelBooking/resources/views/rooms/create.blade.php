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
                            <select name="roomType" id="roomtype">
                                @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Amount</label>
                            <input name="amount" type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="amout">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">MaxGuest</label>
                            <input name="maxGuest" type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Maximum guest">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Desc</label>
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5"
                                placeholder="Description"></textarea>
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