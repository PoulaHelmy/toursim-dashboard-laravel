<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcursionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursion_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('excursion_id');

            $table->string('name');
            $table->string('slug');
            $table->string('short_description');
            $table->longText('overview');
            $table->string('run');
            $table->string('type');
            $table->string('locale')->index();
            $table->unique(['excursion_id', 'locale']);
            $table->foreign('excursion_id')->references('id')->on('excursions')->onDelete('cascade');
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
        Schema::dropIfExists('excursion_translations');
    }
}
