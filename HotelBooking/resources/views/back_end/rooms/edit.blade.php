@extends('back_end.layouts.app')
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Room</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <a class="btn btn-primary float-sm-right" href="{{ route('admin.rooms.index')}}">Back</a>
                {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> @yield('page')</li>
          </ol> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">


            <div class="card card-primary">
                {{-- <div class="card-header">
                <h3 class="card-title">Edit Room</h3>
              </div> --}}
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">View</label>
                            <input type="text" name="view" class="form-control" id="exampleInputEmail1"
                                value="{{ $room->view }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Size</label>
                            <input type="text" name="size" class="form-control" id="exampleInputPassword1"
                                value="{{ $room->size }}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Room Type</label>
                                        <select name="room_type_id" class="form-control select2" style="width: 100%;">
                                            @foreach ($types as $type)
                                            <option {{ $room->room_type_id === $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bed</label>
                                        <select name="bed_id" class="form-control select2" style="width: 100%;">
                                            @foreach ($beds as $bed)
                                            <option {{ $room->bed_id === $bed->id ? 'selected' : '' }}
                                                value="{{ $bed->id }}">{{ $bed->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="mr-5">Status</label>
                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch
                                data-off-color="danger">
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection

@section('myscript')
<script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      
  
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
  
    })
</script>
@endsection