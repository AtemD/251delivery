<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // user_id can be NULL if the order was placed by a user that is not a registered user.
            $table->bigInteger('user_id')->nullable()->unsigned();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            
            $table->tinyInteger('order_type_id')->unsigned();
            $table->foreign('order_type_id')
                ->references('id')
                ->on('order_types')
                ->onDelete('cascade');

            $table->integer('total_price');
            $table->string('delivery_address');
            $table->string('special_requests');
            $table->timestamp('estimate_delivery_time')->nullable();
            $table->timestamp('actual_delivery_time')->nullable();

            $table->string('status');

            $table->tinyInteger('payment_method_id')->unsigned();
                $table->foreign('payment_method_id')
                    ->references('id')
                    ->on('payment_methods')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
