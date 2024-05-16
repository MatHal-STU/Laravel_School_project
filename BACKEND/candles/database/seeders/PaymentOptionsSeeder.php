<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_options')->insert([
            [
                'name' => 'Credit Card',
                'price' => 0.00,
            ],
            [
                'name' => 'PayPal',
                'price' => 0.50,
            ],
            
        ]);
    }
}
