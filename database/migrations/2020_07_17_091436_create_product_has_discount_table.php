<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHasDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_discount', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

            $table->integer('discount_id')->unsigned();
                $table->foreign('discount_id')
                    ->references('id')
                    ->on('discounts')
                    ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['product_id', 'discount_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_discount');
    }
}
