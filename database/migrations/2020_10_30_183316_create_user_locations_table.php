<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                    
            $table->mediumInteger('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
            
            $table->string('postal_code'); // or zip_code
            $table->string('street'); // street/road/block, street name / number
            $table->string('building')->nullable(); // building name or number
            $table->string('specific_information'); // specific/custom information
            $table->string('address');
            $table->json('delivery_addresses')->nullable();

            $table->timestamps();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_locations');
    }
}
