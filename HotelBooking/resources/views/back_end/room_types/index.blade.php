@extends('back_end.layouts.app')
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Room Type Manage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#addRoomType">
                    Launch demo modal
                  </button>                {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> @yield('page')</li>
          </ol> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="addRoomType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Total Room</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roomTypes as $key=>$type)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->description }}</td>
                                <td>{{ 300 }}</td>
                                <td>{{ $type->rooms->count() }}</td>
                                <td>
                                    <a class="btn btn-warning"
                                        href="{{ route('admin.room-types.edit', $type->id) }}">Edit</a>
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
    $('#addRoomType').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
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