<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('excursion_id');
            $table->foreign('excursion_id')->references('id')->on('excursions')->onDelete('cascade');

            $table->morphs('relatable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_booking');
    }
}
