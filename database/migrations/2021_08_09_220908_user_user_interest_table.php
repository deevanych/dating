<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserUserInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_user_interest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('User id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_interest_id')->comment('Interest id');
            $table->foreign('user_interest_id')->references('id')->on('user_interests');
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
        Schema::dropIfExists('user_user_interest');
    }
}
