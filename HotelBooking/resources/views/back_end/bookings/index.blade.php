@extends('back_end.layouts.app')
@section('title', 'Booking Manage')

@push('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endpush
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Booking
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
                                        <th>Check-in</th>
                                        <th>Check-out</th>
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
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    @include('back_end.partials.modal-form')

</section>


@endsection

@push('myscript')
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
                  data: 'check_in',
              },
              {
                  data: 'check_out',
              },
              {
                  data: 'status',
                  render: function(data){
                      return data == 1 ? 'Booked' : 'Canceled'
                }
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

    $(document).on('click', '.delete-booking', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-action').val('SoftDelete')
    })

    $(document).on('click', '.force-delete-booking', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-action').val('ForceDelete');
    })

    $('#form-delete').on('submit', function(e){
        e.preventDefault();
        let id = $('#delete-id').val();
        let action = $('#delete-action').val();
        $.ajax({
            url: `bookings/${id}`,
            method: 'post',
            data: {
                'delete-action': action,
                '_method': 'DELETE'
            },
            // beforeSend:function(){
            //     $('#ok-button').text('Deleting...');
            // },
            success: function(){
                $('#confirm-modal').modal('hide');
                $('#bookings').DataTable().ajax.reload();
                $('#canceledBooking').DataTable().ajax.reload();
                $('#success_content').html('This booking has been canceled');
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
                  data: 'check_in',
              },
              {
                  data: 'check_out',
              },
              {
                  data: 'status',
                  render: function(data){
                      return data == 1 ? 'Booked' : 'Canceled'
                }
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
@endpush