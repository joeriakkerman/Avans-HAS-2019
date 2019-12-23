<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    # TODO: Put GeoJson Columns.
    public function up()
    {
        Schema::create('interest_point', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable();

            $table->point('location');
            $table->geometryCollection('area')->nullable();

            $table->string('name')->unique();
            $table->longText('information');
            $table->string('category');
        });

        Schema::table('interest_point', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('project')->onDelete('set null');
            $table->foreign('category')->references('name')->on('category')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest_point');
    }
}
