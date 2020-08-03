<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->mediumInteger('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
            
            $table->string('postal_code'); //
            $table->string('street'); // street/road/block, street name / number
            $table->string('building'); // building name or number
            $table->string('specific_information'); // specific/custom information
            $table->string('address');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('locationable_id')->unsigned();
            $table->string('locationable_type'); // user/restaurant
            $table->timestamps();

            $table->index(['locationable_type', 'locationable_id', 'city_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
