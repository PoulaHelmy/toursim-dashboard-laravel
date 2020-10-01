<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');

            $table->string('name');
            $table->string('slug');
            $table->string('short_description');
            $table->longText('overview');
            $table->string('run');
            $table->string('type');
            $table->string('locale')->index();
            $table->unique(['package_id', 'locale']);
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
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
        Schema::dropIfExists('package_translations');
    }
}
