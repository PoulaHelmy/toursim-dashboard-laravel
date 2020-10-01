<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcursionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destination_id');
            $table->integer('discount');
            $table->integer('start');
            $table->integer('duration');
            $table->boolean('status')->default(0);
            $table->boolean('featured')->default(0);;
            $table->timestamps();
            $table->foreign('destination_id')->references('id')->on('destination')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excursions');
    }
}
