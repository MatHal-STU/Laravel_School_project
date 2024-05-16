<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $address = new Address();
        $address->user_id = 1;
        $address->first_name = 'Jozko'; 
        $address->last_name = 'Admin';
        $address->save();
    }
}
