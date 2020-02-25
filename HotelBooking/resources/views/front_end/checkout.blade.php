@extends('front_end.layouts.app')

@section('content')

<section class="room-details-area">
    <div class="col-md-12 text-center pb-60">
        <h1><strong>THANKS FOR CHOOSING STAY WITH US!</strong></h1>
        <div class="text-center">
            <i class="far fa-check-circle fa-4x text-success mb-3"></i>
            <h1 class="modal-title">Your booking was successfully created!</h1>
            <h1 class="modal-title">Your booking code is: </h1>
            <h1 class="modal-title">Furthermore information fell free to contact with us via email: {{hotel_information()->email}} or hotline: {{hotel_information()->phone}}</h1>

        </div>
    </div>
</section>

@endsection

@push('style')
<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
<style>
    .row {
        display: -ms-flexbox;
        /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap;
        /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%;
        /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%;
        /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%;
        /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .containerblock {
        background-color: #f2f2f2;
        padding: 20px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }

        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>

@endpush