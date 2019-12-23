<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facets', function (Blueprint $table) {
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('route_id');
            $table->string('information');
        });

        Schema::table('facets', function(Blueprint $table) {
            $table->primary(['project_id', 'route_id']);
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('route')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facets');
    }
}
