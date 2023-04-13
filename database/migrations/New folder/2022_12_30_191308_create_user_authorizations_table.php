<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAuthorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_authorizations', function (Blueprint $table) {
            $table->id();
            $table->string('auth_id');
            $table->string('subject_group');
            $table->string('thesis');
            $table->string('last_validate');
            $table->integer('last_validate_by');
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
        Schema::dropIfExists('user_authorizations');
    }
}
