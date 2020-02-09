@extends('back_end.layouts.app')
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Room Manage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <a class="btn btn-primary float-sm-right" href="">Add Room</a>
                {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> @yield('page')</li>
          </ol> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('page', 'Rooms Manage')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">


            <div class="card">
                {{-- <div class="card-header">
            <h3 class="card-title">Create Room</h3>
          </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Room type</th>
                                <th>View</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rooms as $key=>$room)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $room->roomType->name }}</td>
                                <td>{{ $room->view }}</td>
                                <td>{{ $room->size }}</td>
                                <td>
                                <a class="btn btn-warning" href="{{ route('admin.rooms.edit', $room->id) }}">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <p>Not have any room yet</p>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>


@endsection

@section('myscript')

<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
</script>
@endsection