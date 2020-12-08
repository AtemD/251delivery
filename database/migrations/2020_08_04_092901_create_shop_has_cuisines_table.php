<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopHasCuisinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_has_cuisines', function (Blueprint $table) {
            $table->id();

            $table->integer('shop_id')->unsigned();
                $table->foreign('shop_id')
                    ->references('id')
                    ->on('shops')
                    ->onDelete('cascade');

            $table->smallInteger('cuisine_id')->unsigned();
                $table->foreign('cuisine_id')
                    ->references('id')
                    ->on('cuisines')
                    ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['shop_id', 'cuisine_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_has_cuisines');
    }
}
