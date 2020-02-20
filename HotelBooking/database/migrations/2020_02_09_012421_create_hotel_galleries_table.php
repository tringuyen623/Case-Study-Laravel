<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_galleries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('image');
            $table->unsignedBigInteger('gallery_category_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gallery_category_id')->references('id')->on('gallery_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_galleries');
    }
}
