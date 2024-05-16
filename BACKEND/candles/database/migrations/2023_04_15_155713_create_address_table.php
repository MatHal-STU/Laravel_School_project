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

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('first_name');
            $table->string('last_name', 50);
            $table->string('address', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
