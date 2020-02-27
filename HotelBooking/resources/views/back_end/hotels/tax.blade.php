@extends('back_end.layouts.app')
@section('title',  'Tax Config')

@push('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endpush
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Gallery Category
            <div class=" float-right">
                <button type="button" id="create-tax" class="btn btn-primary" data-toggle="modal"
                    data-target="#add-tax"><i class="fa fa-plus"></i> Add Tax</button>
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
                            <table id="tax" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Rate</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="deleted">
                        <div class="card-body">
                            <table id="taxDeleted" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Rate</th>
                                        <th>Status</th>
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
    <div class="modal fade" id="add-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Tax</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form-tax" method="post">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                                        <input type="hidden" name="tax-id" id="tax-id" value="">
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><strong>Rate</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="rate" name="rate" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><strong>Type</strong> <small class="text-danger">*</small></label>
                                        <select class="form-control" id="type" name="type">
                                            <option>Select</option>
                                            <option value="1">Tax</option>
                                            <option value="2">Fee</option>
                                        </select>
                                    </div>
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
    $("#tax").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.taxes.index") }}',
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
                  data: 'type', name: 'type'
              },
              {
                  data: 'rate', name: 'rate'
              },
              {
                  data: 'status',
                  render: function(data){
                      if(data == 1){
                          return 'Active';
                      } else {
                          return 'Inactive';
                      }
                  }
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

    $('#create-tax').click(function(){
       $('.modal-title').text('Add Tax');
       $('#action').val('Add');
       $('#action_button').html('Save')
    });

    $('#form-tax').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        let action_url = '';
        let type = '';
        let id = $('#tax-id').val();
        let status = jQuery('#status').prop('checked');
        status ? formData.set('status', 1) : formData.set('status', 0);

        if($('#action').val() === 'Add'){
            action_url = "taxes";
        }

        if($('#action').val() === 'Edit'){
            action_url = `taxes/${id}`;
            formData.append('_method', 'PATCH');
        }        

        $.ajax({
            url: action_url,
            method: 'POST',
            data: formData,
            success: function(){
                $('#add-tax').modal('hide');
                $("#tax").DataTable().ajax.reload();
                $('#form-tax')[0].reset();
                $('#success_content').html('Your record has been added');
                $('#success').modal('show');
            },
            cache: false,
            contentType: false,
            processData: false,
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.edit-tax', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `taxes/${id}/edit`,
            success: function(data){
                $('#tax-id').val(id),
                $('#name').val(data.name),
                $('#rate').val(data.rate),
                data.type === 'Fee' ? $('#type').val(1) : $('#type').val(2),
                data.status === 1 ? $('#status').prop('checked', true).change() : $('#status').prop('checked', false).change() ,
                $('#action_button').html('Update'),
                $('#action').val('Edit')
            },
            error: function(error){
                console.log(error)
            }
        });
    });

    $(document).on('click', '.delete-tax', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id)
        
    })

    $('#form-delete').on('submit',function(e){
            e.preventDefault();
            let id = $('#delete-id').val();
            $.ajax({
                url: `taxes/${id}`,
                method: 'POST',
                data: {
                    '_method': 'DELETE'
                },
                beforeSend:function(){
                    $('#ok-button').text('Deleting...');
                },
                success: function(){
                    $('#confirm-modal').modal('hide');
                    $('#tax').DataTable().ajax.reload();
                    $('#taxDeleted').DataTable().ajax.reload();
                    $('#success_content').html('Your record has been deleted');
                    $('#success').modal('show');
                },
                error: function(err){
                    console.log(err);
                }
            })
        })

    // RoomType Deleted
    $("#taxDeleted").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.taxes.listDeleted") }}',
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
                  data: 'type', name: 'type'
              },
              {
                  data: 'rate', name: 'rate'
              },
              {
                  data: 'status', name: 'rate'
              },
              {
                  data: 'action', name: 'action', orderable: false, searchable: false
              }
          ],
          order: [[0, 'asc']]
      });

      $(document).on('click', '.restore-tax', function(){
          let id = $(this).data('id');
          if(confirm('Are you sure to restore?')){
            $.ajax({
              url: `taxes/${id}/restore`,
              success: function(){
                $('#tax').DataTable().ajax.reload();
                $('#taxDeleted').DataTable().ajax.reload();
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