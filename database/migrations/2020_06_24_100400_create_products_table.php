<?php

use App\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status')->default(Product::UNAVAILABLE_PRODUCT);
            
            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');

            $table->integer('section_id')->unsigned();
                $table->foreign('section_id')
                    ->references('id')
                    ->on('sections')
                    ->onDelete('cascade');

            $table->string('image');
            $table->text('description');
            $table->integer('base_price');

            // $table->tinyInteger('available_quantity')->unsigned();
            
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
        Schema::dropIfExists('products');
    }
}
