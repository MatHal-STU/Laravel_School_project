<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Scent;

class ScentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Scent 1
        Scent::create([
            'name' => 'Coffee',
            'photo_path' => 'images/scents/coffee.svg',
            'description' => 'Dominant note in mocha scented candles, providing a warm and energizing fragrance that can help stimulate the senses.',
        ]);

        // Scent 2
        Scent::create([
            'name' => 'Chocolate',
            'photo_path' => 'images/scents/chocolate.svg',
            'description' => 'The sweet and indulgent scent of chocolate is key component providing a rich and satisfying aroma',
        ]);

        // Scent 3
        Scent::create([
            'name' => 'Vanilla',
            'photo_path' => 'images/scents/vanilla.svg',
            'description' => 'The subtle and comforting fragrance of vanilla is often added to candles to provide a sweet and creamy base note,',
        ]);

        
        // Scent 4
        Scent::create([
            'name' => 'Almond',
            'photo_path' => 'images/scents/almond.svg',
            'description' => "The fragrance of sweet almond with warm and nutty notes that evoke memories of baking in grandma's kitchen. A comforting scent that soothes the soul.",
        ]);
        

        // Scent 5
        Scent::create([
            'name' => 'Honey',
            'photo_path' => 'images/scents/honey.svg',
            'description' => 'Golden drops of honey adding a touch of sweetness to the warm and nutty fragrance. This scent envelops you in a comforting embrace.',
        ]);
        
       
        // Scent 6
        Scent::create([
            'name' => 'Cinnamon',
            'photo_path' => 'images/scents/cinamon.svg',
            'description' => 'A hint of cinnamon mingles with the rich and nutty aroma creating a scent that is both warm and spicy. This fragrance wraps you up in its comforting embrace.',
        ]);

        // Scent 7
        Scent::create([
            'name' => 'Lime',
            'photo_path' => 'images/scents/citrus.svg',
            'description' => 'The scent of lime is zesty, bright, and refreshing, with a tangy citrus aroma that can help invigorate and uplift the senses.',
        ]);

        // Scent 8
        Scent::create([
        'name' => 'Aloe',
        'photo_path' => 'images/scents/aloe.svg',
        'description' => 'elicate and soothing fragrance that captures the essence of this healing plant, with subtle green and earthy notes that evoke a sense of natural purity and wellness.',
        ]);

        // Scent 9
        Scent::create([
        'name' => 'Fig',
        'photo_path' => 'images/scents/fig.svg',
        'description' => 'Warm and comforting, with sweet and fruity notes that blend with woody and earthy undertones to create a rich and complex fragrance that can evoke a sense of coziness.',
        ]);

        
        // Scent 10
        Scent::create([
            'name' => 'Melon',
            'photo_path' => 'images/scents/melon.svg',
            'description' => 'Melon has a refreshing and juicy aroma that is reminiscent of summer and tropical fruits. Its subtle sweetness can help to create a relaxing and uplifting atmosphere.',
        ]);

        
        // Scent 11
        Scent::create([
            'name' => 'Green Tea',
            'photo_path' => 'images/scents/green_tea.svg',
            'description' => 'With its delicate herbal and floral notes, the refreshing fragrance of green tea can create a peaceful and calming atmosphere, perfect for relaxation and unwinding.',
        ]);

        // Scent 12
        Scent::create([
            'name' => 'Orange',
            'photo_path' => 'images/scents/citrus.svg',
            'description' => 'With its bright and zesty citrus notes, the fragrance of orange can energize and invigorate the senses, while also providing a warm and comforting aroma.',
        ]);

        // Scent 13
        Scent::create([
            'name' => 'Black Cherry',
            'photo_path' => 'images/scents/cherry.svg',
            'description' => 'With its deep and fruity notes, the fragrance of black cherry can create a warm and inviting atmosphere, perfect for relaxation and unwinding.',
        ]);
    }
}
