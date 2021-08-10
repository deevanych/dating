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
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('User`s name');
            $table->date('birthday_date')->nullable()->comment('User`s bd date');
            $table->string('city')->comment('User`s city');
            $table->boolean('sex')->default(true)->comment('User`s sex (1 - male, 0 - female)');
            $table->tinyText('about')->nullable()->comment('User`s about info');
            $table->string('status')->nullable()->comment('User`s status');
            $table->string('email')->unique()->comment('User`s email');
            $table->boolean('is_verified')->default(false)->comment('User`s verified mark');
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
