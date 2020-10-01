<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncludingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('including_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('including_id');
            $table->text('name');
            $table->string('locale')->index();
            $table->unique(['including_id', 'locale']);
            $table->foreign('including_id')->references('id')->on('including')->onDelete('cascade');

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
        Schema::dropIfExists('including_translations');
    }
}
