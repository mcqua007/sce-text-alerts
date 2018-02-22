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
            $table->string('service_account_number', 13);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street_number', 10);
            $table->string('street_name')->nullable();
            $table->string('zip_code', 10);
            $table->string('phone', 25);
			$table->boolean('mobile_optin')->default(false);
			$table->string('email')->nullable();
            $table->boolean('email_optin')->default(false);
            $table->boolean('on_peak_alert')->default(false);
            $table->boolean('off_peak_alert')->default(false);
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
