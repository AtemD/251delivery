<?php
use App\Tax;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('rate');
            $table->string('rate_type')->default(Tax::PERCENTAGE_TAX);

            $table->integer('shop_id')->unsigned();
                $table->foreign('shop_id')
                    ->references('id')
                    ->on('shops')
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
        Schema::dropIfExists('taxes');
    }
}
