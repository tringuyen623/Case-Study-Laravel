<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('booking_statuses', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->boolean('status');
        //     $table->unsignedBigInteger('booking_id');
        //     $table->timestamps();

        //     $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('booking_statuses');
    }
}
