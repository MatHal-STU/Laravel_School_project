<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Category
        Category::create([
            'name' => 'Candles',
            'description' => 'Choose from over 2000 designer and luxury scented candles for every setting and olfactory taste.',
            'photo_path' => 'images/candles_header.png',
        ]);

        Category::create([
            'name' => 'Lanterns',
            'description' => 'Illuminate your space and indulge your senses with our collection of over 2000 designer and luxury scented candles, perfect for any occasion and every preference.',
            'photo_path' => 'images/lanterns.png',
        ]);

        Category::create([
            'name' => 'Essential oils',
            'description' => 'Experience the natural power and therapeutic benefits of essential oils with our carefully curated collection, featuring a diverse range of pure and high-quality oils.',
            'photo_path' => 'images/oils.png',
        ]);

        Category::create([
            'name' => 'Diffusers',
            'description' => 'Elevate your home or office with our stylish and effective diffusers, designed to disperse the subtle and refreshing aroma of essential oils, creating a calming and inviting atmosphere.',
            'photo_path' => 'images/diffuser.png',
        ]);

        Category::create([
            'name' => 'Incense Sticks',
            'description' => 'Awaken your senses with our handcrafted incense sticks, featuring a selection of exotic scents from around the world to help you relax, focus, and meditate.',
            'photo_path' => 'images/sticks.png',
        ]);

    }
}
