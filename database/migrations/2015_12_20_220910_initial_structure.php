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
            $table->string('service_account_number', 11);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('street_number', 10);
            $table->string('street_name', 50);
            $table->string('zip_code', 5);
            $table->string('phone', 14);
			$table->boolean('mobile_optin')->default(false);
			$table->string('email', 254);
            $table->boolean('email_optin')->default(false);
            $table->boolean('on_peak_alert')->default(false);
            $table->boolean('off_peak_alert')->default(false);
            $table->string('rate', 0);
            $table->timestamp('created_at')->useCurrent();
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
