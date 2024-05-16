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

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('status',25);
            $table->timestamp('created_at');
            $table->bigInteger('delivery_option_id');
            $table->foreign('delivery_option_id')->references('id')->on('delivery_options');
            $table->bigInteger('payment_option_id');
            $table->foreign('payment_option_id')->references('id')->on('payment_options');
            $table->float('total_price');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
