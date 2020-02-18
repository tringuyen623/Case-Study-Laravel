@extends('back_end.layouts.app')

@section('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
{{-- <link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css"> --}}


@endsection
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Amenities
            <div class=" float-right">
                <button type="button" id="create_amenity" class="btn btn-primary" data-toggle="modal"
                    data-target="#add_amenity"><i class="fa fa-plus"></i> Add Amenity</button>
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
                <div class="card-body">
                    <table id="amenity" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
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
    <div class="modal fade" id="add_amenity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <form id="form_amenity" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="name" name="name" class="form-control">
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
                                        <input type="checkbox" id="status" name="my-checkbox" checked data-toggle="toggle">
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <hr />
                                        <button type="reset" class="btn btn-outline-primary"><i
                                                class="fa fa-refresh"></i>
                                            Reset</button>
                                        <input type="hidden" name="action" id="action" value="Add">
                                        <input type="hidden" id="amenity_id">
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


@endsection

@section('myscript')
{{-- <script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> --}}
<script src="/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function(){
    $("#amenity").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.amenities.index") }}',
          columns: [
              {
                  data: 'name'
              },
              {
                  data: 'description'
              },
              {
                  data: 'status'
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

    $('#create_amenity').click(function(){
       $('.modal-title').text('Add New Amenity');
       $('#action_button').html('Save'),
       $('#action').val('Add');
    });

    $('#form_amenity').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);

        let action_url = '';
        let type = '';
        let name = $('#name').val();
        let description = $('#description').val();
        let status = $('#status').prop('checked') ? 1 : 0;
        let id = $('#amenity_id').val();

        if($('#action').val() === 'Add'){
            action_url = "amenities";
            type = 'POST';
        }

        if($('#action').val() === 'Edit'){
            action_url = `amenities/${id}`;
            type = 'PATCH';
        }        

        $.ajax({
            url: action_url,
            method: 'POST',
            data: {
                name: name,
                description: description,
                status: status,
                '_method': type
            },
            success: function(){
                $('#add_amenity').modal('hide');
                $("#amenity").DataTable().ajax.reload();
                $('#form_amenity')[0].reset();
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.edit-amenity', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `amenities/${id}/edit`,
            success: function(data){
                $('#amenity_id').val(data.id),
                $('#name').val(data.name),
                $('#description').val(data.description),
                data.status === 1 ? $('#status').prop('checked', true).change() : $('#status').prop('checked', false).change(),  
                $('.modal-title').text('Update Amenity');
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
@endsection