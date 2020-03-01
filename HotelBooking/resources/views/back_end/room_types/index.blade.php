@extends('back_end.layouts.app')
@section('title', 'Room Type Config')

@push('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
<style>
    .is-danger.input,
    .is-danger.textarea {
        border-color: #f14668;
    }
</style>

@endpush
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Room Type
            <div class=" float-right">

                <button type="button" id="upload_image" class="btn btn-primary" data-toggle="modal"
                    data-target="#add_image"><i class="fa fa-image"></i> Image Upload</button>
                <button type="button" id="create_room_type" class="btn btn-primary" data-toggle="modal"
                    data-target="#add_room_type"><i class="fa fa-plus"></i> Add Room Type</button>
            </div>

        </h2>

    </div><!-- /.container-fluid -->
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
                            <table id="roomType" class="table table-bordered table-striped" style="width:100%">
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
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="deleted">
                        <div class="card-body">
                            <table id="roomTypeDeleted" class="table table-bordered table-striped" style="width: 100%">
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Modal Add -->
    <div class="modal fade" id="add_room_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add room type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_room_type" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                                        <input type="hidden" name="room_type_id" id="room_type_id" value="">
                                        <input type="text" id="name" name="name" class="form-control">
                                        <p class="text-danger name-error"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Short Code</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="short-code" name="short_code" class="form-control">
                                        <p class="text-danger short-code-error"></p>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Higher Capacity</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="text" id="higher_capacity" name="higher_capacity"
                                            class="form-control">
                                        <p class="text-danger higher-error"></p>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Kids Capacity</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="text" id="kids_capacity" name="kids_capacity" class="form-control">
                                        <p class="text-danger kid-error"></p>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Base Price</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="base_price" name="base_price" class="form-control">
                                        <p class="text-danger base-price-error"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Size</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="size" name="size" class="form-control">
                                        <p class="text-danger size-error"></p>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Description</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="description" name="description" class="form-control">
                                        <p class="text-danger description-error"></p>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Status</strong> <small class="text-danger">*</small></label>
                                        <input type="checkbox" id="status" name="my-checkbox" checked
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

    <!-- Modal Image -->
    <div class="modal fade" id="add_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">IMAGE UPLOAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_image" method="post" enctype="multipart/form-data">@csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Select Room type</strong> <small
                                                class="text-danger">*</small></label>
                                        <select class="form-control" id="room_type" name="room_type">
                                            <option value="">Select</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <label for="featured" class=" mr-5"> Featured Images</label>
                                        <input type="checkbox" id="featured" name="featured" checked
                                            data-toggle="toggle" data-off-color="danger">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Image</strong> <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            placeholder="Image">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <hr />
                                        <button type="reset" class="btn btn-outline-primary"><i
                                                class="fa fa-refresh"></i>
                                            Reset</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
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
    $("#roomType").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.room-types.list") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                      }
              },
              {
                  data: 'name', name: 'name'
              },
              {
                  data: 'description', name: 'description'
              },
              {
                  data: 'base_price', name: 'base_price'
              },
              {
                  data: 'Total Rooms',
              },
              {
                  data: 'action', name: 'action', orderable: false, searchable: false
              }
          ],
          order: [[0, 'asc']]
      });
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#create_room_type').click(function(){
       $('.modal-title').text('Add Room Type');
       $('#action').val('Add');
       $('#form_room_type')[0].reset();
       clearError();
    });

    $('#form_room_type').on('submit', function(e){
        e.preventDefault();

        let action_url = '';
        let type = '';
        let name = $('#name').val()
        let short_code = $('#short-code').val()
        let higher_capacity = $('#higher_capacity').val()
        let kids_capacity = $('#kids_capacity').val()
        let base_price = $('#base_price').val()
        let size = $('#size').val()
        let description = $('#description').val()
        let status = $('#status').prop('checked')
        let id = $('#room_type_id').val();

        status ? status = 1 : status = 0;

        if($('#action').val() === 'Add'){
            action_url = "room-types";
            type = 'POST';
        }

        if($('#action').val() === 'Edit'){
            action_url = `room-types/${id}`;
            type = 'PATCH';
        }        

        $.ajax({
            url: action_url,
            method: 'POST',
            data: {
                name: name,
                short_code: short_code,
                higher_capacity: higher_capacity,
                kids_capacity: kids_capacity,
                base_price: base_price,
                size: size,
                description: description,
                status: status,
                '_method': type
            },
            success: function(){
                $('#add_room_type').modal('hide');
                $("#roomType").DataTable().ajax.reload();
                $('#form_room_type')[0].reset();
                $('#success_content').html('Your record has been added');
                $('#success').modal('show');
                clearError()
            },
            error: function(err){
               showError(err)
            }
        });
    });

    $('#form_image').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.room-types.storeImage")}}',
            method: 'POST',
            data: formData,
            success: function(){
                $('#add_image').modal('hide');
                $('#form_image')[0].reset();
                $('#success_content').html('Your record has been added');
                $('#success').modal('show');

            },
            cache: false,
            contentType: false,
            processData: false,
            error: function(err){
                console.log(err);
            }
        })
    })

    $(document).on('click', '.edit-room-type', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `room-types/${id}/edit`,
            success: function(data){
                $('#room_type_id').val(id),
                $('#name').val(data.name),
                $('#short-code').val(data.short_code),
                $('#higher_capacity').val(data.higher_capacity),
                $('#kids_capacity').val(data.kids_capacity),
                $('#base_price').val(data.base_price),
                $('#size').val(data.size),
                $('#description').val(data.description),
                $('#action_button').html('Update'),
                $('#action').val('Edit'),
                data.status === 1 ? $('#status').prop('checked', true).change() : $('#status').prop('checked', false).change(),
                clearError()
            },
            error: function(error){
                console.log(error)
            }
        });
    });

    $(document).on('click', '.delete-room-type', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-action').val('SoftDelete');
    })

    $(document).on('click', '.force-delete', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-action').val('ForceDelete');
    })

    $('#form-delete').on('submit', function(e){
        e.preventDefault();
        let id = $('#delete-id').val();
        let deleteAction = $('#delete-action').val();

        $.ajax({
            url: `room-types/${id}`,
            method: 'post',
            data: {
                'delete-action': deleteAction,
                '_method': 'DELETE'
            },
            success: function(){
                $('#confirm-modal').modal('hide');
                $('#roomType').DataTable().ajax.reload();
                $('#roomTypeDeleted').DataTable().ajax.reload();
                $('#success_content').html('Your record has been deleted');
                $('#success').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        })
    })

    // RoomType Deleted
    $("#roomTypeDeleted").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.room-types.listDeleted") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                      }
              },
              {
                  data: 'name', name: 'name'
              },
              {
                  data: 'description', name: 'description'
              },
              {
                  data: 'base_price', name: 'base_price'
              },
              {
                  data: 'Total Rooms',
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
                $('#roomType').DataTable().ajax.reload();
                $('#roomTypeDeleted').DataTable().ajax.reload();
                $('#success_content').html('Your record has been restore');
                $('#success').modal('show');
              },
              error: function(err){
                  console.log(err);
              }
          });
        }
      })

      function showError(err){
        err.responseJSON.errors.name ? ($('.name-error').html(err.responseJSON.errors.name), $('#name').addClass('input is-danger')) : ($('.name-error').empty(), $('#name').removeClass('input is-danger')),
                err.responseJSON.errors.higher_capacity ? ($('.higher-error').html(err.responseJSON.errors.higher_capacity), $('#higher_capacity').addClass('input is-danger')) : ($('.higher-error').empty(), $('#higher_capacity').removeClass('input is-danger')),
                err.responseJSON.errors.short_code ? ($('.short-code-error').html(err.responseJSON.errors.short_code), $('#short-code').addClass('input is-danger')) : ($('.short-code-error').empty(), $('#short-code').removeClass('input is-danger')),
                err.responseJSON.errors.kids_capacity ? ($('.kid-error').html(err.responseJSON.errors.kids_capacity), $('#kids_capacity').addClass('input is-danger')) : ($('.kid-error').empty(), $('#kids_capacity').removeClass('input is-danger')),
                err.responseJSON.errors.base_price ? ($('.base-price-error').html(err.responseJSON.errors.base_price), $('#base_price').addClass('input is-danger')) : ($('.base-price-error').empty(), $('#base_price').removeClass('input is-danger')),
                err.responseJSON.errors.size ? ($('.size-error').html(err.responseJSON.errors.size), $('#size').addClass('input is-danger')) : ($('.size-error').empty(), $('#size').removeClass('input is-danger')),
                err.responseJSON.errors.description ? ($('.description-error').html(err.responseJSON.errors.description), $('#description').addClass('input is-danger')) : ($('.description-error').empty(), $('#description').removeClass('input is-danger'))
      }
      
      function clearError(){
        $('.name-error').empty(), $('#name').removeClass('input is-danger')
                $('.higher-error').empty(), $('#higher_capacity').removeClass('input is-danger')
                $('.short-code-error').empty(), $('#short-code').removeClass('input is-danger')
                $('.kid-error').empty(), $('#kids_capacity').removeClass('input is-danger')
                $('.base-price-error').empty(), $('#base_price').removeClass('input is-danger')
                $('.size-error').empty(), $('#size').removeClass('input is-danger')
                $('.description-error').empty(), $('#description').removeClass('input is-danger')
      }
});
</script>
@endpush