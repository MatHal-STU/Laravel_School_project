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

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('ean_code', 13);
            $table->string('name', 100);
            $table->text('description');
            $table->text('ingredients');
            $table->string('color', 20);
            $table->float('price');
            $table->boolean('trending')->default(false);
            $table->float('discount');
            $table->integer('stock');
            $table->integer('burn_hours');
            $table->bigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('product_types');
            $table->string('photo_path', 250);
            $table->string('photo_path2', 250);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
