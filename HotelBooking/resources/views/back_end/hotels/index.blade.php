@extends('back_end.layouts.app')
@section('title', 'Hotel Config')

@push('style')
<link rel="stylesheet" href="/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">


@endpush
@section('content_header')

<div class="content-header">
    <div class="container-fluid">
        <h2>Hotel Information
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
                    <table id="hotel" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Currency</th>
                                <th>Check-in Time</th>
                                <th>Check-out Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <!-- /.row -->

    <!-- Modal Add -->
    <div class="modal fade" id="edit_hotel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <form id="form_hotel" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><strong>Address</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="address" name="address" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Phone</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Email</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Currency</strong> <small class="text-danger">*</small></label>
                                        <input type="text" id="currency" name="currency" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Currency Symbol</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="text" id="currency_symbol" name="currency_symbol"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Check-in Time</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="time" id="check_in_time" name="check_in_time" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Check-out Time</strong> <small
                                                class="text-danger">*</small></label>
                                        <input type="time" id="check_out_time" name="check_out_time"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="form-group col-sm-12">
                                        <hr />
                                        <button type="reset" class="btn btn-outline-primary"><i
                                                class="fa fa-refresh"></i>
                                            Reset</button>
                                        <input type="hidden" name="action" id="action" value="Add">
                                        <input type="hidden" id="hotel_id">
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

@push('myscript')
<script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function(){
    $("#hotel").DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.hotel.index") }}',
          columns: [
              
              {
                  data: 'name'
              },
              {
                  data: 'address'
              },
              {
                  data: 'phone'
              },
              {
                  data: 'email'
              },
              {
                  data: 'currency'
              },
              {
                  data: 'check_in_time'
              },
              {
                  data: 'check_out_time'
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


    $('#form_hotel').on('submit', function(e){
        e.preventDefault();

        let id = $('#hotel_id').val();   
        let name = $('#name').val()
        let address = $('#address').val()
        let phone = $('#phone').val()
        let email = $('#email').val()
        let check_in_time = $('#check_in_time').val()
        let check_out_time = $('#check_out_time').val()
        let currency = $('#currency').val()
        let currency_symbol = $('#currency_symbol').val()

        $.ajax({
            url: `hotel/${id}`,
            method: 'POST',
            data: {
                name: name,
                address: address,
                phone: phone,
                email: email,
                check_in_time: check_in_time,
                check_out_time: check_out_time,
                currency: currency,
                currency_symbol: currency_symbol,
                '_method': 'PATCH'
            },
            success: function(){
                $('#edit_hotel').modal('hide');
                $("#hotel").DataTable().ajax.reload();
                $('#form_hotel')[0].reset();
                $('#success_content').html('Your record has been updated');
                $('#success').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.edit-hotel', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `hotel/${id}/edit`,
            success: function(data){
                $('#hotel_id').val(data.id);
                $('#name').val(data.name);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#check_in_time').val(data.check_in_time);
                $('#check_out_time').val(data.check_out_time);
                $('#currency').val(data.currency);
                $('#currency_symbol').val(data.currency_symbol);
            },
            error: function(error){
                console.log(error)
            }
        });
    });
});

</script>
@endpush