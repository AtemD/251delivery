<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHasProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_has_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->integer('product_id')->unsigned();
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

            $table->tinyInteger('quantity')->unsigned();
            $table->integer('amount')->unsigned();
            $table->string('special_request')->nullable(); // special instructions to the shop or restaurant
            $table->timestamps();

            $table->unique(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_has_product');
    }
}
