<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 6)->unique();
            $table->string('service_account_number', 4);
            $table->boolean('updated')->default(false);
            $table->string('address');
			$table->string('rate_plan', 7);
			$table->string('phone')->nullable();
            $table->boolean('number_is_mobile')->default(false);
			$table->boolean('mobile_optin')->default(false);
			$table->string('email')->nullable();
			$table->boolean('email_optin')->default(false);
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
         Schema::drop('accounts');
    }
}
