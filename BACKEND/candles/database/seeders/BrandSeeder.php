<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand modedl
        Brand::create([
            'name' => 'Candle CO',
            'description' => 'Very good candles from Sweden',
        ]);

        Brand::create([
            'name' => 'Travel Candle',
            'description' => 'Very good candles from Sweden',
        ]);
    }
}
