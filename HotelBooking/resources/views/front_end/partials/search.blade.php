<div id="colorlib-reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 search-wrap">
                <form method="GET" action="{{ route('check-available') }}" class="colorlib-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="arrival">Arrival Date</label>
                                <input id="arrival" type="text" class="form-control clickable input-md"
                                    name="search[arrival]" value="{{ $search['arrival'] }}"
                                    placeholder="&#xf133;  Arrival Date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="departure">Departure Date</label>
                                <input id="departure" type="text" class="form-control clickable input-md"
                                    name="search[departure]" value="{{ $search['departure'] }}"
                                    placeholder="&#xf133;  Dearture Date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="adults">Adults</label>
                                <div class="form-field">
                                    <i class="icon icon-arrow-down3"></i>
                                    <select name="search[adults]" id="people" class="form-control">
                                        @for ($i = 1; $i <= 5 ; $i++) <option
                                            {{ $search['adults'] == $i ? 'selected' : null }} value="{{ $i }}">{{ $i }}
                                            </option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="children">Children</label>
                                <div class="form-field">
                                    <i class="icon icon-arrow-down3"></i>
                                    <select name="search[children]" id="people" class="form-control">
                                        @for ($i = 0; $i <= 3 ; $i++) <option
                                            {{ $search['children'] == $i ? 'selected' : null }} value="{{ $i }}">
                                            {{ $i }}
                                            </option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="submit" id="submit" value="Check Available"
                                class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('style')

<style>
    input {
        padding: 10px;
        font-family: FontAwesome, "Open Sans", Verdana, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        border-radius: 0 !important;
    }

    .form-control {
        border-radius: 0 !important;
        font-size: 12x;
    }

    .clickable {
        cursor: pointer;
    }
</style>
@endpush

@push('script')
<script src="/js/bootstrap-datepicker.js"></script>
<script>
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var arrival = $('#arrival').datepicker({
        format: 'yyyy/mm/dd',
        beforeShowDay: function(date) {
            return date.valueOf() >= now.valueOf();
        },
        autoclose: true
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > departure.datepicker("getDate").valueOf() || !departure.datepicker("getDate").valueOf()) {
            
            var newDate = new Date(ev.date);
            newDate.setDate(newDate.getDate() + 1);
            departure.datepicker("update", newDate);
        }
        
        $('#departure')[0].focus();
    });
    
    var departure = $('#departure').datepicker({
        format: 'yyyy/mm/dd',
        beforeShowDay: function(date) {
            if (!arrival.datepicker("getDate").valueOf()) {
                return date.valueOf() >= new Date().valueOf();
            } else {
                return date.valueOf() > arrival.datepicker("getDate").valueOf();
            }
        },
        autoclose: true
        
        }).on('changeDate', function(ev) {});
</script>
@endpush