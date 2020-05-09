<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('user_organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('organization_id');
            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('organization_id')
                ->references('id')
                ->on('organizations');
            $table->unique(['user_id', 'organization_id']);
            $table->index(['organization_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('user_organizations');
    }
}
