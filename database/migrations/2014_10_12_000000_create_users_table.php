<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sub')->unique();
            $table->string('name')->nullable();
            $table
                ->string('email')
                ->nullable()
                ->index();
            $table->boolean('email_verified')->default(false);
            $table->string('image_url')->nullable();
            $table->dateTime('profile_loaded_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
