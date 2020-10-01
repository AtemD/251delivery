<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->tinyInteger('user_account_status_id')->nullable()->unsigned();
            $table->foreign('user_account_status_id')
                ->references('id')
                ->on('user_account_statuses')
                ->onDelete('cascade');

            $table->bigInteger('status_by')->nullable()->unsigned();
            $table->foreign('status_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamp('status_date')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
