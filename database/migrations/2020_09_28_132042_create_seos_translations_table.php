<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeosTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seos_id');
            $table->string('page_title');
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->string('og_title');
            $table->string('og_description');
            $table->string('og_image');
            $table->string('locale')->index();
            $table->unique(['seos_id', 'locale']);
            $table->foreign('seos_id')->references('id')->on('seos')->onDelete('cascade');
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
        Schema::dropIfExists('seos_translations');
    }
}
