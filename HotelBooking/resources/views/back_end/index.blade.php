@extends('back_end.layouts.app')
@section('title', 'Dash Board')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $bookings->count() }}</h3>

            <p>Bookings</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $bookings->sum('no_of_guests')}}</h3>

            <p>Guests</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ count($rooms) }}</h3>

            <p>Rooms</p>
          </div>
          <div class="icon">
            <i class="ion ion-home"></i>
          </div>
          <a href="{{ route('admin.rooms.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{ App\Payment::all()->sum('amount') }}<sup
                style="font-size: 20px">{{ hotel_information()->currency_symbol }}</sup></h3>

            <p>Total Avenue</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <div class="col-md">
        <div class="card">
          <div class="card-header bg-white">
            <h4> Room Status

              <div class="float-md-right">
                <a href="#" class="btn btn-sm btn-square btn-room btn-success mr-1">Available</a>
                <a href="#" class="btn btn-sm btn-square btn-room btn-danger mr-1">Booked</a>
              </div>


            </h4>
          </div>
          <div class="card-body  table-responsive">
            <div class="form-row mb-2">

              {{-- <div class="col-md">
                <a class="btn btn-primary " href="#"><i class="fa fa-plus"></i> Add Reservation</a>

              </div> --}}
              <div class="col-md">
                <form class="form-inline float-right">
                  <div class="form-group">
                    <div class="input-group">
                      <div role="wrapper" class="gj-datepicker gj-datepicker-bootstrap gj-unselectable input-group">
                        <input name="date" type="text" id="date" value="{{$data['date']}}" class="form-control"></div>
                    </div>
                  </div>
                  <div class="form-group pl-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>

                  </div>
                </form>
              </div>
            </div>
            <hr>

            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="room_type">
                <table class="table table-bordered mb-0">
                  <thead class="bg-primary text-white">
                    <tr>
                      <th>Room Type</th>
                      <th>Room</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (App\RoomType::all() as $roomType)
                    <tr>
                      <td class="align-content-center font-weight-bold">{{ $roomType->name }}</td>
                      <td>
                        @foreach ($roomType->rooms as $room)
                        @if ($room->available($data['date']))
                        <a href="#"
                          class="btn btn-lg btn-square btn-room btn-danger mr-1 mt-1">{{ $room->room_number }}</a>
                        @else
                        <a href="#"
                          class="btn btn-lg btn-square btn-room btn-success mr-1 mt-1">{{ $room->room_number }}</a>
                        @endif
                        @endforeach
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header font-weight-bold bg-white">
            <i class="fa fa-line-chart"></i>
            MONTHLY RESERVATION
          </div>
          <div class="card-body p-0" id="reservation" style="height: 350px;">

          </div>
        </div>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->


</section>

@endsection

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gl-morris-js@0.5.3/morris.css">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

@endpush

@push('myscript')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"
  integrity="sha256-TabprKdeNXbSesCWLMrcbWSDzUhpAdcNPe5Q53rn9Yg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"
  integrity="sha256-0rg2VtfJo3VUij/UY9X0HJP7NET6tgAY98aMOfwP0P8=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function () {
            $('#date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy/mm/dd',

            });
            var months = @php echo json_encode(array_values(month_arr())) ; @endphp;

            new Morris.Line({
                element: 'reservation',
                data: @php echo $totalChart ; @endphp,
                xkey: 'month',
                ykeys: ['booking'],
                labels: ['BOOKING'],
                xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
                    var month = months[x.getMonth()];
                    return month;
                },
                dateFormat: function(x) {
                    var month = months[new Date(x).getMonth()];
                    return month;
                },
            });
        });
</script>
@endpush