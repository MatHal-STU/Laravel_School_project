<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'United States',
            'tax' => 0.07
        ]);

        Country::create([
            'name' => 'Slovakia',
            'tax' => 0.1
        ]);

        Country::create([
            'name' => 'Czech Republic',
            'tax' => 0.2
        ]);

    }
}
