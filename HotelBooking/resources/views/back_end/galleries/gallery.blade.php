@extends('back_end.layouts.app')

@push('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endpush
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Gallery Category
            <div class=" float-right">
                <button type="button" id="create-gallery" class="btn btn-primary" data-toggle="modal"
                    data-target="#add-image"><i class="fa fa-plus"></i> Add New Gallery</button>
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
                            <table id="gallery" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="deleted">
                        <div class="card-body">
                            <table id="gallery-deleted" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Image</th>
                                        <th>Category</th>
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
    <div class="modal fade" id="add-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form-image" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Image</strong> <small class="text-danger">*</small></label>
                                        <input type="file" accept="image/gif, image/jpeg, image/png" name="image"
                                            id="file-image">
                                        <div> <img src="" id="image-holder" style="height: 200px"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><strong>Category</strong> <small class="text-danger">*</small></label>
                                        <select class="form-control" id="gallery-category" name="gallery_category_id">
                                            <option value="">Select</option>
                                            @foreach($cates as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @endforeach
                                        </select> </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <hr />
                                        <button type="reset" class="btn btn-outline-primary"><i
                                                class="fa fa-refresh"></i>
                                            Reset</button>
                                        <input type="hidden" name="action" id="action" value="Add">
                                        <input type="hidden" id="gallery-id">
                                        <button type="submit" class="btn btn-primary btn-submit" name="action-button"
                                            id="action-button"><i class="fa fa-save"></i>
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
    $("#gallery").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.galleries.index") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                      }
              },
              {
                  data: 'image',
                  render: function(data, type, row, meta){
                      return `<img src="${data}" alt="" style="height: 100px;">`
                  }
              },
              {
                  data: 'gallery_category_id', name: 'category'
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

    $('#create-gallery').click(function(){
       $('.modal-title').text('Add Category');
       $('#action').val('Add');
    });

    $("#file-image").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#image-holder");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image-holder').attr('src', e.target.result);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
        } else {
                    alert("This browser does not support FileReader.");
        }
    });

    $('#form-image').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);

        let action_url = '';
        let type = '';
        let id = $('#gallery-id').val();

        status ? status = 1 : status = 0;

        if($('#action').val() === 'Add'){
            action_url = "galleries";
        }

        if($('#action').val() === 'Edit'){
            action_url = `galleries/${id}`;
            formData.append('_method', 'PATCH');
        }        

        $.ajax({
            url: action_url,
            method: 'POST',
            data: formData,
            success: function(){
                $('#add-image').modal('hide');
                $("#gallery").DataTable().ajax.reload();
                $('#form-image')[0].reset();
                $('#image-holder').attr('src', null);
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

    $(document).on('click', '.edit-gallery', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `galleries/${id}/edit`,
            success: function(data){
                $('#gallery-id').val(data.id)
                $('#gallery-category').val(data.gallery_category_id),
                $('#image-holder').attr('src', data.image),
                $('#action-button').html('Update'),
                $('#action').val('Edit')
            },
            error: function(error){
                console.log(error)
            }
        });
    });

    $(document).on('click', '.delete-gallery', function(){
        let id = $(this).data('id');
        $('#delete-id').val(id);
    })

    $('#form-delete').on('submit', function(e){
        e.preventDefault();
        let id = $('#delete-id').val();
        $.ajax({
            url: `galleries/${id}`,
            method: 'post',
            data: {
                '_method': 'DELETE'
            },
            beforeSend:function(){
                $('#ok-button').text('Deleting...');
            },
            success: function(){
                $('#confirm-modal').modal('hide');
                $('#gallery').DataTable().ajax.reload();
                $('#gallery-deleted').DataTable().ajax.reload();
                $('#success_content').html('Your record has been deleted');
                $('#success').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        })
    })

    // RoomType Deleted
    $("#gallery-deleted").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.galleries.listDeleted") }}',
          columns: [
              {
                  data: 'id',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                      }
              },
              {
                  data: 'image',
                  render: function(data, type, row, meta){
                      return `<img src="${data}" alt="" style="height: 100px;">`
                  }
              },
              {
                  data: 'gallery_category_id', name: 'category'
              },
              {
                  data: 'action', name: 'action', orderable: false, searchable: false
              }
          ],
          order: [[0, 'asc']]
      });

      $(document).on('click', '.restore-gallery', function(){
          let id = $(this).data('id');
          if(confirm('Are you sure to restore?')){
            $.ajax({
              url: `galleries/${id}/restore`,
              success: function(){
                $('#gallery').DataTable().ajax.reload();
                $('#gallery-deleted').DataTable().ajax.reload();
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