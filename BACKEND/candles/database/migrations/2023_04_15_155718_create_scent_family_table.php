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

        Schema::create('scent_families', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('scent_id');
            $table->foreign('scent_id')->references('id')->on('scents');
            $table->bigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scent_families');
    }
};
