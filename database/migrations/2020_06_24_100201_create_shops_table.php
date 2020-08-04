<?php

use App\Models\Shop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('email');
            $table->string('phone_number');

            $table->tinyInteger('shop_type_id')->unsigned();
                $table->foreign('shop_type_id')
                    ->references('id')
                    ->on('shop_types')
                    ->onDelete('cascade');

            $table->string('banner_image');
            $table->string('logo_image');
            $table->string('average_preparation_time');
            $table->string('account_status')->default(Shop::UNVERIFIED_SHOP);
            $table->string('availability_status')->default(Shop::UNAVAILABLE_SHOP);

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
        Schema::dropIfExists('shops');
    }
}
