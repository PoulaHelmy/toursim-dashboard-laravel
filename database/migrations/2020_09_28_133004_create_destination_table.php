<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationTable extends Migration
{

    public function up()
    {
        Schema::create('destination', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('destination');
    }
}
