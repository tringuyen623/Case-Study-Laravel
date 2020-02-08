<div id="colorlib-reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 search-wrap">
                <form method="post" action="{{ route('bookings.store') }}" class="colorlib-form">
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
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
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
                                        <option value="#">0</option>
                                        <option value="#">1</option>
                                        <option value="#">2</option>
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