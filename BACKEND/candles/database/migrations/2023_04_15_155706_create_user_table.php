<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 320);
            $table->string('password', 64);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone_number', 15)->nullable();
            $table->string('role',15);
            $table->timestamp('registered_at');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
