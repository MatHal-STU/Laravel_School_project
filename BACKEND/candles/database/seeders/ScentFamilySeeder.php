<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Scent;
use App\Models\Product;

class ScentFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $product = Product::find(1);
        $scents = Scent::whereIn('id', ['1', '2', '3'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(2);
        $scents = Scent::whereIn('id', ['7', '4', '9'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(3);
        $scents = Scent::whereIn('id', ['12', '6', '5'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(4);
        $scents = Scent::whereIn('id', ['11', '10', '8'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(5);
        $scents = Scent::whereIn('id', ['13', '3', '4'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(6);
        $scents = Scent::whereIn('id', ['13', '5', '3'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(7);
        $scents = Scent::whereIn('id', ['12', '4', '1'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(9);
        $scents = Scent::whereIn('id', ['11'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(10);
        $scents = Scent::whereIn('id', ['12', '7'])->get();
        $product->scents()->attach($scents);

        $product = Product::find(11);
        $scents = Scent::whereIn('id', ['9'])->get();
        $product->scents()->attach($scents);
    }
}
