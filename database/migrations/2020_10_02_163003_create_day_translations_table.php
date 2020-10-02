<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id');
            $table->string('title');
            $table->string('summery');
            $table->string('locale')->index();
            $table->unique(['day_id', 'locale']);
            $table->timestamps();
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_translations');
    }
}
