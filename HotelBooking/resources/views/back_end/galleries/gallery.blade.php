@extends('back_end.layouts.app')

@section('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endsection
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
                                        <div id="image-holder"> </div>
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


    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-notify modal-danger" role="document">
            <!--Content-->
            <form method="POST">
                @csrf
                <div class="modal-content">
                    <!--Body-->
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="far fa-times-circle fa-8x text-danger mb-3"></i>
                            <h4>Are you sure you want to remove this data?</h4>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <button type="submit" name="ok_button" id="ok_button" class="btn btn-danger">Remove</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
            <!--/.Content-->
        </div>
    </div>

    <div id="success" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="far fa-check-circle fa-8x text-success mb-3"></i>
                        <h4 class="modal-title">Awesome!</h4>
                    </div>
                    <p class="text-center" id="success_content">Your booking has been confirmed. Check your email for
                        detials.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
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
                  data: 'image', name: 'image'
              },
              {
                  data: 'category', name: 'category'
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
                $("<img />", {"src": e.target.result,"class": "thumb-image", "width": "180px", 'height':"200px"}).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
        } else {
                    alert("This browser does not support FileReader.");
        }
    });

    $('#form_category').on('submit', function(e){
        e.preventDefault();

        let action_url = '';
        let type = '';
        let name = $('#name').val();
        let id = $('#gallery_category_id').val();

        status ? status = 1 : status = 0;

        if($('#action').val() === 'Add'){
            action_url = "gallery-categories";
            type = 'POST';
        }

        if($('#action').val() === 'Edit'){
            action_url = `gallery-categories/${id}`;
            type = 'PATCH';
        }        

        $.ajax({
            url: action_url,
            method: 'POST',
            data: {
                name: name,
                '_method': type
            },
            success: function(){
                $('#add-image').modal('hide');
                $("#gallery").DataTable().ajax.reload();
                $('#form-image')[0].reset();
                $('#success_content').html('Your record has been added');
                $('#success').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.edit-gallery-category', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `gallery-categories/${id}/edit`,
            success: function(data){
                $('#gallery_category_id').val(id),
                $('#name').val(data.name),
                $('#action-button').html('Update'),
                $('#action').val('Edit')
            },
            error: function(error){
                console.log(error)
            }
        });
    });

    $(document).on('click', '.delete-category-gallery', function(){
        let id = $(this).data('id');
        $('#ok_button').click(function(){
            $.ajax({
                url: `gallery-categories/${id}`,
                method: 'delete',
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success: function(){
                    $('#confirm-modal').modal('hide');
                    $('#gallery').DataTable().ajax.reload();
                    $('#success_content').html('Your record has been deleted');
                    $('#success').modal('show');
                },
                error: function(err){
                    console.log(err);
                }
            })
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
                  data: 'name', name: 'name'
              },
              {
                  data: 'action', name: 'action', orderable: false, searchable: false
              }
          ],
          order: [[0, 'asc']]
      });

      $(document).on('click', '.restore-gallery-category', function(){
          let id = $(this).data('id');
          if(confirm('Are you sure to restore?')){
            $.ajax({
              url: `gallery-categories/${id}/restore`,
              success: function(){
                $('#categgalleryCategory').DataTable().ajax.reload();
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
@endsection