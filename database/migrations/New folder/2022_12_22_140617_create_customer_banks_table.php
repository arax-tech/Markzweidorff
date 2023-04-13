<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_banks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('payrol_number');
            $table->string('bank_name');
            $table->string('rit_number');
            $table->string('account_number');
            $table->string('swift_number');
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
        Schema::dropIfExists('customer_banks');
    }
}
