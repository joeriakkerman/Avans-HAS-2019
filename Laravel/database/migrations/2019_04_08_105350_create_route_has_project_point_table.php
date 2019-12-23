<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteHasProjectPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_has_interest_point', function (Blueprint $table) {
            $table->unsignedInteger('point_id');
            $table->unsignedInteger('route_id');

            $table->primary(['point_id', 'route_id']);
        });

        Schema::table('route_has_interest_point', function (Blueprint $table) {
            $table->foreign('point_id')->references('id')->on('interest_point')->onDelete('cascade');
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
        Schema::dropIfExists('route_has_interest_point');
    }
}
