<div id="colorlib-reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 search-wrap">
                <form method="GET" action="{{ route('check-available') }}" class="colorlib-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="arrival">Arrival Date</label>
                                <input id="arrival" type="text" class="form-control clickable input-md"
                                    name="search[arrival]" value="{{ Session::get('search')['arrival'] }}"
                                    placeholder="  Arrival Date" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="departure">Departure Date</label>
                                <input id="departure" type="text" class="form-control clickable input-md"
                                    name="search[departure]" value="{{ Session::get('search')['departure'] }}"
                                    placeholder="  Dearture Date" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group m-b-0">
                                    <label for="js-select-special">No of Rooms</label>
                                    <div class="input-group-icon" id="js-select-special">

                                        <input class="form-control" type="text" name="passengers" value=""
                                            placeholder="{{ count(Session::get('search')['rooms'])}} Room, {{ array_sum(Session::get('search')['adults']) + array_sum(Session::get('search')['children'])}} Guest"
                                            disabled="disabled" style="disabled:pointer;" id="info">
                                    </div>
                                    <div class="dropdown-select">
                                        <ul class="list-room">
                                            @for ($i = 0; $i < count(Session::get('search')['rooms']); $i++) <li
                                                class="list-room__item">
                                                <input type="hidden" name="search[rooms][]"
                                                    value="{{Session::get('search')['rooms'][$i]}}">
                                                <span class="list-room__name"><span style="display: none;"
                                                        class="minus reduce-room">-</span> Room
                                                    <span id="number-of-room"></span></span>
                                                <ul class="list-person">
                                                    <li class="list-person__item">
                                                        <span class="name">Adults</span>
                                                        <div class="quantity quantity1">
                                                            <span class="minus">-</span>
                                                            <input class="inputQty" type="number"
                                                                name="search[adults][]" min="1"
                                                                value="{{Session::get('search')['adults'][$i]}}">
                                                            <span class="plus">+</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-person__item">
                                                        <span class="name">Children</span>
                                                        <div class="quantity quantity2">
                                                            <span class="minus">-</span>
                                                            <input class="inputQty" type="number"
                                                                name="search[children][]" min="0"
                                                                value="{{Session::get('search')['children'][$i]}}">
                                                            <span class="plus">+</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                                </li>
                                                @endfor

                                        </ul>
                                        <div class="list-room__footer">
                                            <a href="#" id="btn-add-room">Add room</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
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
    body {
        counter-reset: section;
    }

    #number-of-room:before {
        font-family: "Poppins", Arial, sans-serif;
        counter-increment: section;
        content: counter(section);
    }

    .row-space {
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        -moz-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .row-refine {
        margin: 0 -15px;
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    blockquote,
    p,
    pre,
    dl,
    dd,
    ol,
    ul,
    figure,
    hr,
    fieldset,
    legend {
        margin: 0;
        padding: 0;
    }

    /**
 * Remove trailing margins from nested lists.
 */
    li>ol,
    li>ul {
        margin-bottom: 0;
    }


    input,
    textarea {
        outline: none;
        margin: 0;
        border: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        width: 100%;
        font-size: 18px;
        font-family: inherit;
    }

    input:disabled {
        cursor: pointer;
    }

    .form-control[disabled],
    fieldset[disabled] .form-control {
        cursor: pointer;
    }

    .m-b-0 {
        margin-bottom: 0;
    }


    .input-group-icon {
        position: relative;
        width: 100%;
    }

    .input-icon {
        font-size: 24px;
        color: #808080;
        position: absolute;
        line-height: 60px;
        right: 20px;
        top: 0;
        width: 20px;
        background: #fff;
        text-align: center;
        cursor: pointer;
    }

    .input-icon::before {
        display: block;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    @media (max-width: 767px) {
        .m-b-0 {
            margin-bottom: 26px;
        }
    }

    /* ==========================================================================
   #SELECT
   ========================================================================== */
    .quantity {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        float: right;
    }

    .quantity>input {
        -webkit-appearance: none;
        width: 55px;
        text-align: center;
        font-size: 18px;
        color: #555;
        font-weight: 700;
    }

    .minus,
    .plus {
        display: inline-block;
        width: 32px;
        height: 32px;
        line-height: 26px;
        text-align: center;
        border: 2px solid #ccc;
        font-size: 24px;
        color: #ccc;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    .minus:hover,
    .plus:hover {
        background: #6c7ae0;
        border-color: #6c7ae0;
        color: #fff;
    }

    .list-room {
        list-style: none;
        max-height: 324px;
        overflow-y: auto;
        padding-right: 20px;
    }

    .list-room__item {
        margin-bottom: 20px;
    }

    .list-room__footer {
        padding-top: 22px;
        border-top: 1px solid #e5e5e5;
    }

    .list-room__name {
        margin-bottom: 10px;
        display: block;
        font-weight: 700;
        color: #999;
    }

    .list-person {
        list-style: none;
    }

    .list-person .list-person__item:last-child {
        margin-bottom: 0;
    }

    .list-person__item {
        margin-bottom: 10px;
    }

    .list-person__item::after {
        content: "";
        clear: both;
        display: table;
    }

    .list-person__item .name {
        font-size: 18px;
        color: #555;
        font-weight: 700;
        display: inline-block;
        margin-top: 5px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #btn-add-room {
        font-family: inherit;
        font-size: 16px;
        color: #6c7ae0;
        font-weight: 700;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    #btn-add-room:hover {
        text-decoration: underline;
    }

    .dropdown-select {
        display: none;
        font-family: "Poppins", Arial, sans-serif;
        position: absolute;
        min-width: 385px;
        left: 0;
        right: 0;
        top: -webkit-calc(100% + 2px);
        top: -moz-calc(100% + 2px);
        top: calc(100% + 2px);
        background: #fff;
        z-index: 999;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        padding: 30px 45px;
        padding-right: 25px;
    }

    .dropdown-select.show {
        display: block;
    }

    .open .input-icon::before {
        -webkit-transform: rotate(-180deg);
        -moz-transform: rotate(-180deg);
        -ms-transform: rotate(-180deg);
        -o-transform: rotate(-180deg);
        transform: rotate(-180deg);
    }

    .open .input-icon.zmdi-plus:before {
        content: '\f273';
    }

    /* ==========================================================================
   #CARD
   ========================================================================== */
    /*  */
</style>

@endpush

@push('script')
<script>
    jQuery(document).ready(function ($) {
    'use strict';
    
    try {
        var body = $('body,html');
    
        var selectSpecial = $('#js-select-special');
        var info = selectSpecial.find('#info');
        var dropdownSelect = selectSpecial.parent().find('.dropdown-select');
        var listRoom = dropdownSelect.find('.list-room');
        var btnAddRoom = $('#btn-add-room');
        var totalRoom = {!! json_encode(Session::get('search')['rooms']) !!}.length;

        listRoom.on('click', '.reduce-room', function(e){
            e.preventDefault();
            totalRoom--;
            $(this).parents('li.list-room__item').remove()
            updateRoom();
            console.log(totalRoom);
        })
    
        selectSpecial.on('click', function (e) {
            e.stopPropagation();
            $(this).toggleClass("open");
            dropdownSelect.toggleClass("show");
        });
    
        dropdownSelect.on('click', function (e) {
            e.stopPropagation();
        });
    
        body.on('click', function () {
            selectSpecial.removeClass("open");
            dropdownSelect.removeClass("show");
        });
    
    
        listRoom.on('click', '.plus', function () {
            var that = $(this);
            var qtyContainer = that.parent();
            var qtyInput = qtyContainer.find('input[type=number]');
            var oldValue = parseInt(qtyInput.val());
            var newVal = oldValue + 1;
            if(newVal <= 4){
                qtyInput.val(newVal);
            }
    
            updateRoom();
        });
    
        listRoom.on('click', '.minus', function () {
            var that = $(this);
            var qtyContainer = that.parent();
            var qtyInput = qtyContainer.find('input[type=number]');
            var min = qtyInput.attr('min');
    
            var oldValue = parseInt(qtyInput.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            qtyInput.val(newVal);
    
            updateRoom();
        });
    
    
    
        listRoom.on('change', '.inputQty', function () {
            var that = $(this);
            if (isNumber(that.val())) {
                var qtyVal = parseInt(that.val());
                if (that.val().length === 0) {
                    qtyVal = 0;
                }
    
                if (qtyVal < 0) {
                    qtyVal = 0;
                }
                that.val(qtyVal);
    
                updateRoom();
            }
        });
    
        function isNumber(n){
            return typeof(n) != "boolean" && !isNaN(n);
        }
    
        btnAddRoom.on('click', function (e) {
            e.preventDefault();
    
            totalRoom++;

    
            listRoom.append('<li class="list-room__item">' + `<input type="hidden" id="search-adult" name="search[rooms][]" value="${totalRoom}">` +
                '                                        <span class="list-room__name"><span class="minus reduce-room" style="display: none;">-</span> Room <span id="number-of-room"></span></span>' +
                '                                        <ul class="list-person">' +
                '                                            <li class="list-person__item">' +
                '                                                <span class="name">' +
                '                                                    Adults' +
                '                                                </span>' +
                '                                                <div class="quantity quantity1">' +
                '                                                    <span class="minus">' +
                '                                                        -' +
                '                                                    </span>' +
                '                                                    <input type="number" name="search[adults][]" min="0" value="1" class="inputQty">' +
                '                                                    <span class="plus">' +
                '                                                        +' +
                '                                                    </span>' +
                '                                                </div>' +
                '                                            </li>' +
                '                                            <li class="list-person__item">' +
                '                                                <span class="name">' +
                '                                                    Children' +
                '                                                </span>' +
                '                                                <div class="quantity quantity2">' +
                '                                                    <span class="minus">' +
                '                                                        -' +
                '                                                    </span>' +
                '                                                    <input type="number" name="search[children][]" min="0" value="0" class="inputQty">' +
                '                                                    <span class="plus">' +
                '                                                        +' +
                '                                                    </span>' +
                '                                                </div>' +
                '                                            </li>' +
                '                                        </ul>');

            updateRoom();
        });

            
    
    
        function countAdult() {
            var listRoomItem = listRoom.find('.list-room__item');
            var totalAdults = 0;
    
            listRoomItem.each(function () {
                var that = $(this);
                var numberAdults = parseInt(that.find('.quantity1 > input').val());
    
                totalAdults = totalAdults + numberAdults;
    
            });
    
            return totalAdults;
        }
    
        function countChildren() {
            var listRoomItem = listRoom.find('.list-room__item');
            var totalChildren = 0;
    
            listRoomItem.each(function () {
                var that = $(this);
                var numberChildren = parseInt(that.find('.quantity2 > input').val());
    
                totalChildren = totalChildren + numberChildren;
            });
    
            return totalChildren;
        }
    
        function updateRoom() {
            // if({!! json_encode(Session::get('search')['adults']) !!}.toString().split`,`.map(x=>+x).reduce((a,b)=> a+ b, 0) > 0){
            //     var totalAd = {!! json_encode(Session::get('search')['adults']) !!}.toString().split`,`.map(x=>+x).reduce((a,b)=> a+ b, 0);
            //     var totalChi = {!! json_encode(Session::get('search')['children']) !!}.toString().split`,`.map(x=>+x).reduce((a,b)=> a+ b, 0);
            // }else{
                var totalAd = parseInt(countAdult());
                var totalChi = parseInt(countChildren());
            // }
            
            
            var guests = 'Guest';
            var rooms = 'Room, ';
    
            if (totalAd > 1) {
                guests = 'Guests';
            }
    
            if (totalRoom > 1) {
                rooms = 'Rooms, ';
            }
    
            var infoText = totalRoom + ' ' + rooms + (totalAd + totalChi) + ' ' + guests;
    
            info.val(infoText);

            if(totalRoom > 1){
                $('.reduce-room').show();
            }else {
                $('.reduce-room').hide();
            }
        }
        
    
    } catch (e) {
        console.log(e);
    }
    /*[ Select 2 Config ]
        ===========================================================*/
    
    try {
        var selectSimple = $('.js-select-simple');
    
        selectSimple.each(function () {
            var that = $(this);
            var selectBox = that.find('select');
            var selectDropdown = that.find('.select-dropdown');
            selectBox.select2({
                dropdownParent: selectDropdown
            });
        });
    
    } catch (err) {
        console.log(err);
    }

    
    
    // try {
    //     var addSearchValue = $('search-room');
        
    //     sel
    // }

});

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