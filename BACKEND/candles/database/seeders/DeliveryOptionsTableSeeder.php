<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('delivery_options')->insert([
            ['name' => 'Standard', 'price' => 5.00],
            ['name' => 'Express', 'price' => 10.00],
            ['name' => 'Next Day', 'price' => 15.00],
        ]);
    }
}
