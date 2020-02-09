<div id="colorlib-reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 search-wrap">
                <form method="GET" action="{{ route('check') }}" class="colorlib-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Check-in:</label>
                                <div class="form-field">
                                    <i class="icon icon-calendar2"></i>
                                    <input type="text" name="date_in" id="date" class="form-control date"
                                        placeholder="Check-in date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Check-out:</label>
                                <div class="form-field">
                                    <i class="icon icon-calendar2"></i>
                                    <input type="text" name="date_out" id="date" class="form-control date"
                                        placeholder="Check-out date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="adults">Adults</label>
                                <div class="form-field">
                                    <i class="icon icon-arrow-down3"></i>
                                    <select name="no_of_guest" id="people" class="form-control">
                                        @for ($i = 1; $i <= 5 ; $i++) <option {{ $i === 2 ? 'selected' : '' }}
                                            value="{{ $i }}">{{ $i }}
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
                                    <select name="people" id="people" class="form-control">
                                        @for ($i = 0; $i <= 3 ; $i++) <option value="{{ $i }}">{{ $i }}
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