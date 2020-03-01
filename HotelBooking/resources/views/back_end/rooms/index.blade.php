@extends('back_end.layouts.app')
@section('title', 'Rooms Config')

@push('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">

@endpush
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Room
            <div class=" float-right">
                <button type="button" id="create_room" class="btn btn-primary" data-toggle="modal"
                    data-target="#add-room"><i class="fa fa-plus"></i> Add Room</button>
            </div>

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
                        <a class="nav-link" href="#deleted" role="tab" data-toggle="tab">Deleted</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="active">
                        <div class="card-body">
                            <table id="rooms" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Room Number</th>
                                        <th>Room Type</th>
                                        <th>Bed Type</th>
                                        <th>Extra Bed</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="deleted">

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
    <div class="modal fade" id="add-room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <form id="form-room" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Room Number</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="room-number" name="room_number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>View</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="view" name="view" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Select Room type</strong> <small
                                                class="text-danger">*</small></label>
                                        <select class="form-control" id="room-type-id" name="room_type_id">
                                            <option value="">Select</option>
                                            @foreach(App\RoomType::all() as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Select Bed type</strong> <small
                                                class="text-danger">*</small></label>
                                        <select class="form-control" id="bed-id" name="bed_id">
                                            <option value="">Select</option>
                                            @foreach(App\Bed::all() as $bed)
                                            <option value="{{ $bed->id }}">{{ $bed->bed_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Extra-bed</strong> <small class="text-danger">*</small></label>
                                        <input type="checkbox" id="extra-bed" name="extra_bed" checked
                                            data-toggle="toggle" data-off-color="danger" data-on="YES" data-off="NO">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Status</strong> <small class="text-danger">*</small></label>
                                        <input type="checkbox" id="is-active" name="my-checkbox" checked
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
                                        <input type="hidden" id="room-id">
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
    </div>

</section>

@include('back_end.partials.modal-form')


@endsection

@push('myscript')
<script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function(){
        let no = 0;
    $("#rooms").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.rooms.list") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
              },
              {
                  data: 'room_number'
              },
              {
                  data: 'room_type_id'
              },
              {
                  data: 'bed_id'
              },
              {
                  data: 'extra_bed'
              },
              {
                  data: 'is_active'
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

    $('#create_room').click(function(){
       $('.modal-title').text('Add New Room');
       $('#action_button').html('Save'),
       $('#action').val('Add');
    });

    $('#form-room').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);

        let action_url = '';
        let type = '';
        let room_number = $('#room-number').val();
        let room_type_id = $('#room-type-id').val();
        let bed_id = $('#bed-id').val()
        let view = $('#view').val();
        let extra_bed = $('#extra-bed').prop('checked') ? 1 : 0;
        let is_active = $('#is-active').prop('checked') ? 1 : 0;
        let id = $('#room-id').val();

        if($('#action').val() === 'Add'){
            action_url = "rooms";
            type = 'POST';
        }

        if($('#action').val() === 'Edit'){
            action_url = `rooms/${id}`;
            type = 'PATCH';
        }        

        $.ajax({
            url: action_url,
            method: 'POST',
            data: {
                room_number: room_number,
                room_type_id: room_type_id,
                bed_id: bed_id,
                view: view,
                extra_bed: extra_bed,
                is_active: is_active,
                '_method': type
            },
            success: function(){
                $('#add-room').modal('hide');
                $("#rooms").DataTable().ajax.reload();
                $('#form-room')[0].reset();
                $('#success_content').html('Your record has been updated');
                $('#success').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.edit-room', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `rooms/${id}/edit`,
            success: function(data){
                $('#room-id').val(data.id),
                $('#room-number').val(data.room_number),
                $('#room-type-id').val(data.room_type_id),
                $('#bed-id').val(data.bed_id),
                $('#view').val(data.view),
                data.extra_bed === 1 ? $('#extra-bed').prop('checked', true).change() : $('#extra-bed').prop('checked', false).change(),  
                data.is_active === 1 ? $('#status').prop('checked', true).change() : $('#status').prop('checked', false).change(),  
                $('.modal-title').text('Update Room');
                $('#action_button').html('Update'),
                $('#action').val('Edit')
            },
            error: function(error){
                console.log(error)
            }
        });
    });
});

</script>
@endpush