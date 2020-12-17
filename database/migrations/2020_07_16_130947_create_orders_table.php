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

            $table->string('number')->unique();

            $table->bigInteger('user_id')->nullable()->unsigned();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');

            $table->json('cart')->nullable();
            
            $table->tinyInteger('order_type_id')->unsigned();
            $table->foreign('order_type_id')
                ->references('id')
                ->on('order_types')
                ->onDelete('cascade');

            $table->string('delivery_address');
            $table->string('special_requests')->nullable();
            $table->timestamp('estimate_delivery_time')->nullable();
            $table->timestamp('actual_delivery_time')->nullable();

            $table->tinyInteger('payment_method_id')->unsigned();
                $table->foreign('payment_method_id')
                    ->references('id')
                    ->on('payment_methods')
                    ->onDelete('cascade');
                    
            $table->tinyInteger('order_status_id')->nullable()->unsigned();
                $table->foreign('order_status_id')
                    ->references('id')
                    ->on('order_statuses')
                    ->onDelete('cascade');

            $table->tinyInteger('payment_status_id')->nullable()->unsigned();
            $table->foreign('payment_status_id')
                ->references('id')
                ->on('payment_statuses')
                ->onDelete('cascade');
    
            $table->bigInteger('status_by')->nullable()->unsigned();
                $table->foreign('status_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            
            $table->timestamp('status_date')->nullable();
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
