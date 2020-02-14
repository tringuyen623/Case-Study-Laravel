@extends('back_end.layouts.app')

@section('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endsection
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
                {{-- <div class="card-header">
            <h3 class="card-title">Create Room</h3>
          </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="roomType" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                {{-- <th>NO</th> --}}
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Action</th>
                                {{-- <th>Total Room</th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @forelse ($roomTypes as $key=>$type)
                            <tr>
                                <td>{{ ++$key }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->description }}</td>
                        <td>{{ 300 }}</td>
                        <td>{{ $type->rooms->count() }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.room-types.edit', $type->id) }}">Edit</a>
                        </td>
                        </tr>
                        @empty
                        <p>Not have any room yet</p>
                        @endforelse

                        </tbody> --}}
                    </table>
                </div>
                <!-- /.card-body -->
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
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Short Name</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="short_name" name="short_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label><strong>Higher Capacity</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="text" id="higher_capacity" name="higher_capacity"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Kids Capacity</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="text" id="kids_capacity" name="kids_capacity" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Base Price</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="base_price" name="base_price" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Description</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="description" name="description" class="form-control">
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
                            <form class="" action="" method="post" enctype="multipart/form-data">@csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Select Room type</strong> <small
                                                class="text-danger">*</small></label>
                                        <select class="form-control" name="room_type">
                                            <option value="">Select</option>
                                            {{-- @foreach($roomTypes as $roomType) --}}
                                            <option value="1">kaka</option>
                                            {{-- @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <label for="featured" class=" mr-5"> Featured Images</label>
                                        <input type="checkbox" name="my-checkbox" data-bootstrap-switch
                                            data-off-color="danger">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Image</strong> <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control" name="image" placeholder="Image">
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
</section>


@endsection

@section('myscript')
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
                  data: 'name', name: 'name'
              },
              {
                  data: 'description', name: 'description'
              },
              {
                  data: 'base_price', name: 'base_price'
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

    $('#create_room_type').click(function(){
       $('.modal-title').text('Add Room Type');
       $('action').val('Add');
    });

    $('#form_room_type').on('submit', function(e){
        event.preventDefault();
        let action_url = '';
        let type = '';
        let name = jQuery('#name').val()
        let short_code = jQuery('#short_name').val()
        let higher_capacity = jQuery('#higher_capacity').val()
        let kids_capacity = jQuery('#kids_capacity').val()
        let base_price = jQuery('#base_price').val()
        let description = jQuery('#description').val()
        let status = jQuery('#status').prop('checked')
        let id = $('#room_type_id').val();

        status ? status = 1 : status = 0;

        if($('#action').val() === 'Add'){
            action_url = "room-types/store";
        }

        if($('#action').val() === 'Edit'){
            action_url = `room-types/${id}`
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
                description: description,
                status: status,
                '_method': 'PATCH'
            },
            success: function(){
                $('#add_room_type').modal('hide');
                $("#roomType").DataTable().ajax.reload();
                $('#form_room_type')[0].reset();
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.edit-room-type', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `room-types/${id}/edit`,
            success: function(data){
                $('#room_type_id').val(id),
                $('#name').val(data.name),
                $('#short_name').val(data.short_code),
                $('#higher_capacity').val(data.higher_capacity),
                $('#kids_capacity').val(data.kids_capacity),
                $('#base_price').val(data.base_price),
                $('#description').val(data.description),
                $('#action_button').html('Update'),
                $('#action').val('Edit'),
                data.status === 1 ? $('#status').prop('checked', true) : $('#status').prop('checked', false)
            },
            error: function(error){
                console.log(error)
            }
        });
    });
});
    


    // $('body').on('click', '.edit-room-type', function(){
    //     let id = $(this).data('id');
    //     $.get(
    //         `room-types/${id}/edit`, function(data){
    //             $('#name').val(data.name),
    //             $('#short_name').val(data.short_code),
    //             $('#higher_capacity').val(data.higher_capacity),
    //             $('#kids_capacity').val(data.kids_capacity),
    //             $('#base_price').val(data.base_price),
    //             $('#description').val(data.description),
    //             $('.btn-submit').val('edit')
    //             data.status === 1 ? $('#status').prop('checked', true) : $('#status').prop('checked', false)
    //         }
    //     )
    //     if(
    //         $('.btn-submit').val() === 'edit'
    //     ){
    //         let name = jQuery('#name').val()
    //     let short_code = jQuery('#short_name').val()
    //     let higher_capacity = jQuery('#higher_capacity').val()
    //     let kids_capacity = jQuery('#kids_capacity').val()
    //     let base_price = jQuery('#base_price').val()
    //     let description = jQuery('#description').val()
    //     let status = jQuery('#status').prop('checked')
    //     status ? status = 1 : status = 0;

    //         $.ajax({
    //         url: `admin/room-types/${id}`,
    //         type: 'patch',
    //         data: $('form_room_type').serialize(),
    //         data: {
    //             name: name,
    //             short_code: short_code,
    //             higher_capacity: higher_capacity,
    //             kids_capacity: kids_capacity,
    //             base_price: base_price,
    //             description: description,
    //             status: status
    //         },
    //         success: function(){
    //             $('#add_room_type').modal('hide');
    //             ajax.reload();
    //         },
    //         error: function(err){
    //             console.log(err);
    //         }
    //     });
    //     }
    // })
    


    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // $('.btn-submit').click(function(e){
    //     e.preventDefault();

    //     let name = jQuery('#name').val()
    //     let short_code = jQuery('#short_name').val()
    //     let higher_capacity = jQuery('#higher_capacity').val()
    //     let kids_capacity = jQuery('#kids_capacity').val()
    //     let base_price = jQuery('#base_price').val()
    //     let description = jQuery('#description').val()
    //     let status = jQuery('#status').prop('checked')
    //     status ? status = 1 : status = 0;
        
    //     $.ajax({
    //         url: '{{ route("admin.room-types.store") }}',
    //         method: 'post',
    //         data: {
    //             name: name,
    //             short_code: short_code,
    //             higher_capacity: higher_capacity,
    //             kids_capacity: kids_capacity,
    //             base_price: base_price,
    //             description: description,
    //             status: status
    //         },
    //         success: function(){
    //             $('#add_room_type').modal('hide');
    //             ajax.reload();
    //         },
    //         error: function(err){
    //             console.log(err);
    //         }
    //     });
    // });

    // $('.btn-submit').click(function(e){
    //     e.preventDefault();

    //     let name = jQuery('#name').val()
    //     let short_code = jQuery('#short_name').val()
    //     let higher_capacity = jQuery('#higher_capacity').val()
    //     let kids_capacity = jQuery('#kids_capacity').val()
    //     let base_price = jQuery('#base_price').val()
    //     let description = jQuery('#description').val()
    //     let status = jQuery('#status').prop('checked')
    //     status ? status = 1 : status = 0;
        
    //     $.ajax({
    //         url: '{{ route("admin.room-types.store") }}',
    //         method: 'post',
    //         data: {
    //             name: name,
    //             short_code: short_code,
    //             higher_capacity: higher_capacity,
    //             kids_capacity: kids_capacity,
    //             base_price: base_price,
    //             description: description,
    //             status: status
    //         },
    //         success: function(){
    //             $('#add_room_type').modal('hide');
    //             ajax.reload();
    //         },
    //         error: function(err){
    //             console.log(err);
    //         }
    //     });
    // });


</script>
@endsection