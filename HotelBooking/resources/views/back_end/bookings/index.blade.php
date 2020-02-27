@extends('back_end.layouts.app')
@section('title',  'Booking Manage')

@section('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endsection
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Room
            {{-- <div class=" float-right">
                <button type="button" id="create_room" class="btn btn-primary" data-toggle="modal"
                    data-target="#add_room"><i class="fa fa-plus"></i> Add Room</button>
            </div> --}}

        </h2>
    </div>
</div>

@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs d-print-none mb-2" role="tablist">
                    <li class="nav-item ">
                        <a class="nav-link  active " href="#active" role="tab" data-toggle="tab"
                            aria-selected="true">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#canceled" role="tab" data-toggle="tab">Cancel</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="active">
                        <div class="card-body">
                            <table id="bookings" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Booking Code</th>
                                        <th>Customer Name</th>
                                        <th>Number Of Guest</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="canceled">
                        <div class="card-body">
                            <table id="canceledBooking" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Booking Code</th>
                                        <th>Customer Name</th>
                                        <th>Number Of Guest</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        {{-- <div class="card-body">
                            <table id="canceledBooking" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Booking Code</th>
                                        <th>Customer Name</th>
                                        <th>Base Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> --}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Modal Add -->
    {{-- <div class="modal fade" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_room" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Select Room type</strong> <small
                                                class="text-danger">*</small></label>
                                        <select class="form-control" id="room_type_id" name="room_type_id">
                                            <option value="">Select</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>View</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="view" name="view" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Size</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="size" name="size" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Status</strong> <small class="text-danger">*</small></label>
                                        <input type="checkbox" id="is_active" name="my-checkbox" checked
                                            data-toggle="toggle" data-off-color="danger">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <hr />
                                        <button type="reset" class="btn btn-outline-primary"><i
                                                class="fa fa-refresh"></i>
                                            Reset</button>
                                        <input type="hidden" name="action" id="action" value="Add">
                                        <input type="hidden" id="room_id">
                                        <button type="submit" class="btn btn-primary btn-submit" name="action_button"
                                            id="action_button"><i class="fa fa-save"></i>
                                            Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @include('back_end.partials.modal-form')

</section>


@endsection

@section('myscript')
<script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function(){
        let no = 0;
    $("#bookings").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.bookings.index") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
              },
              {
                  data: 'id'
              },
              {
                  data: 'customer_id', name: 'customer_id'
              },
              {
                  data: 'no_of_guests'
              },
              {
                  data: 'base_price'
              },
              {
                  data: 'action', name: 'action', orderable: false, searchable: false
              }
          ]
      });
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.cancel-booking', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id);

    })

    $('#form-delete').on('submit', function(e){
        e.preventDefault();
        let id = $('#delete-id').val();
        $.ajax({
            url: `bookings/${id}`,
            method: 'post',
            data: {
                '_method': 'DELETE'
            },
            // beforeSend:function(){
            //     $('#ok-button').text('Deleting...');
            // },
            success: function(){
                $('#confirm-modal').modal('hide');
                $('#bookings').DataTable().ajax.reload();
                $('#success_content').html('Booking has been canceled');
                $('#success').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        })
    })

    // RoomType Deleted
    $("#canceledBooking").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.bookings.listDeleted") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                      }
              },
              {
                  data: 'id'
              },
              {
                  data: 'customer_id', name: 'customer_id'
              },
              {
                  data: 'no_of_guests'
              },
              {
                  data: 'created_at'
              },
              {
                  data: 'action', name: 'action', orderable: false, searchable: false
              }
          ],
          order: [[0, 'asc']]
      });

      $(document).on('click', '.restore-room-type', function(){
          let id = $(this).data('id');
          if(confirm('Are you sure to restore?')){
            $.ajax({
              url: `room-types/${id}/restore`,
              success: function(){
                $('#booking').DataTable().ajax.reload();
                $('#canceledBooking').DataTable().ajax.reload();
                $('#success_content').html('Your record has been restore');
                $('#success').modal('show');
              },
              error: function(err){
                  console.log(err);
              }
          });
        }
      })
});

</script>
@endsection