<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEWalletAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_wallet_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number')->unique();
            
            $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->bigInteger('balance')->unsigned(); // based on deposits and withdrawals
            $table->boolean('is_active')->default(0);

            $table->tinyInteger('e_wallet_account_status_id')->unsigned();
                $table->foreign('e_wallet_account_status_id')
                    ->references('id')
                    ->on('e_wallet_account_statuses')
                    ->onDelete('cascade');

            $table->bigInteger('status_by')->unsigned();
                $table->foreign('status_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->mediumInteger('currency_id')->unsigned();
                $table->foreign('currency_id')
                    ->references('id')
                    ->on('currencies')
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
        Schema::dropIfExists('e_wallet_accounts');
    }
}
