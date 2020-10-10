<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code_cust', 45)->unique();
            $table->string('name_cust', 150);
            $table->text('address_cust')->nullable();
            $table->string('city_cust', 45)->nullable();
            $table->string('province_cust', 45)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country_cust', 45)->nullable();
            $table->string('phone_cust', 45)->nullable();
            $table->string('email_cust', 45)->nullable();
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
        Schema::drop('customers');
    }
}
