<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHasTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_taxes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

            $table->integer('tax_id')->unsigned();
                $table->foreign('tax_id')
                    ->references('id')
                    ->on('taxes')
                    ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['product_id', 'tax_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_taxes');
    }
}
