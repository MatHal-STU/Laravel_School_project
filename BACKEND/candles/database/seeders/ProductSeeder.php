<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  

        // Product using the Product model
        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Mocha Travel Candle',
            'description' => "Our scented candle with mocha fragrance is the perfect addition to any room, filling it with a warm and inviting aroma that will make you feel right at home. Made with high-quality essential oils and natural soy wax, this candle is long-lasting and eco-friendly, so you can enjoy the rich scent without worrying about harmful chemicals or pollutants. With a burn time of up to 50 hours, this candle will keep your home smelling delicious for days on end, providing a cozy and comforting ambiance that's perfect for relaxing evenings at home.",
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 28.00,
            'discount' => 0.0,
            'stock' => 10,
            'burn_hours' => 50,
            'brand_id' => 2,
            'type_id' => 1,
            'color' => "brown",
            'photo_path' => "images/candle5.jpg",
            'photo_path2' => "images/mocha2.jpg",
            'trending' => false,
        ]);

        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Lime & Sweet Fig Candle',
            'description' => "Introducing our lime and sweet fig scented candle, a delightful addition to any living space that is sure to create a warm and inviting atmosphere. Infused with the sweet and tangy aroma of lime and the subtle sweetness of fig, this candle will transport you to a tropical paradise, enveloping your senses with a deliciously refreshing fragrance. With its beautiful and soothing scent, this candle is perfect for unwinding after a long day, creating a cozy and comfortable ambiance for relaxing evenings at home.",
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 20.00,
            'discount' => 0.0,
            'stock' => 20,
            'burn_hours' => 40,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "white",
            'photo_path' => 'images/candle3.jpg',
            'photo_path2' => 'images/wcandle.jpg',
            'trending' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Spiced Orange Candle',
            'description' => "Introducing our spiced orange scented candle, a perfect addition to any room that will infuse your living space with a warm and inviting aroma, evoking memories of cozy winter nights spent by the fire. With a delightful blend of spicy cinnamon and sweet orange, this candle will create an uplifting and comforting atmosphere that will make you feel right at home. Light up this spiced orange scented candle to create a cozy ambiance that is perfect for unwinding after a long day or creating a warm and inviting atmosphere for entertaining guests.",
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 25.00,
            'discount' => 0.0,
            'stock' => 10,
            'burn_hours' => 40,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "white",
            'photo_path' => "images/candle2.jpg",
            'photo_path2' => "images/wcandle.jpg",
            'trending' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Aloe Vera Candle',
            'description' => "Aloe Vera scented candle will refresh and calm any room, bringing the healing properties of this plant into your living space. The subtle and soothing fragrance of Aloe Vera will transport you to a tranquil oasis, creating a peaceful atmosphere that will help you relax and unwind after a long day. Light up this Aloe Vera scented candle to create a spa-like ambiance, perfect for meditation, yoga, or unwinding after a hectic day. The therapeutic properties of Aloe Vera promote relaxation and reduce stress, making it an excellent choice for anyone looking to create a peaceful and rejuvenating environment in their living space.",
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 30.00,
            'discount' => 0.0,
            'stock' => 10,
            'burn_hours' => 40,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "white",
            'photo_path' => "images/candle1.jpg",
            'photo_path2' => "images/wcandle.jpg",
            'trending' => true,
        ]);


        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Black Cherry Candle',
            'description' => "Indulge in the rich and delicious aroma of our Black Cherry scented candle, a perfect addition to any room that will fill your living space with the sweet and fruity fragrance of ripe black cherries. The enticing scent of this candle will create a warm and inviting ambiance, making you feel like you're in a cherry orchard on a sunny summer day. Light up this Black Cherry scented candle to create a cozy and romantic atmosphere, perfect for date nights, dinner parties, or simply enjoying a good book with a glass of wine. The sweet and fruity fragrance of ripe black cherries is sure to awaken your senses and create a joyful and uplifting mood.",
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 28.00,
            'discount' => 0.0,
            'stock' => 10,
            'burn_hours' => 8,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "white",
            'photo_path' => "images/candle4.jpg",
            'photo_path2' => "images/mocha2.jpg",
            'trending' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Honey Scented Candle',
            'description' => 'Light up this Honey and Cherry scented candle to create a cozy and romantic atmosphere, perfect for date nights, dinner parties, or simply enjoying a good book with a glass of wine. The combination of sweet black cherries and golden honey will awaken your senses and create a joyful and uplifting mood. With its beautiful and elegant design, this scented candle is not only a sensory delight but also a visual treat that will enhance the decor of any room. Made with high-quality ingredients, our Honey and Cherry scented candle burns evenly and lasts for hours, providing you with a long-lasting and delightful fragrance experience. Treat yourself or someone special to the sweet and fruity aroma of our Honey and Cherry scented candle today!',
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 28.00,
            'discount' => 15.0,
            'stock' => 10,
            'burn_hours' => 10,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "yellow",
            'photo_path' => "images/candle6.jpg",
            'photo_path2' => "images/honey.jpg",
            'trending' => true,
        ]);

        
        Product::create([
            'category_id' => 1,
            'ean_code' => '1234567890123',
            'name' => 'Meditation Candle',
            'description' => 'Relax and unwind with the soothing and comforting scent of our Meditation candle, infused with the fragrant combination of sweet oranges and roasted almonds. This scented candle is the perfect addition to your meditation routine, creating a calming and peaceful ambiance that will help you find your inner zen. With the aroma of sweet oranges and roasted almonds, this Meditation scented candle provides a warm and inviting fragrance that will uplift your spirits and soothe your mind. The sweet and citrusy scent of oranges blended with the nutty aroma of roasted almonds creates a delightful and inviting aroma that is both refreshing and comforting.',
            'ingredients' => '100% soy wax made in the USA, FSC-certified wood wick, and fragrance oils (paraben-free, phthalate-free, vegan and cruelty-free)',
            'price' => 28.00,
            'discount' => 15.0,
            'stock' => 10,
            'burn_hours' => 10,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "yellow",
            'photo_path' => "images/candle7.jpg",
            'photo_path2' => "images/candle72.jpg",
            'trending' => false,
        ]);

        Product::create([
            'category_id' => 2,
            'ean_code' => '1234567890123',
            'name' => 'Modern Lantern',
            'description' => 'Illuminate your living space with our sleek and stylish modern lantern. Crafted with high-quality materials and expert craftsmanship, this lantern is the perfect accessory to add a touch of elegance and sophistication to any room. Its minimalist design and clean lines create a contemporary look that complements any decor style, making it a versatile piece that can be used both indoors and outdoors.  The lantern is made with durable metal and features a powder-coated finish that adds to its sleek and modern look. The glass panels allow for ample light to shine through, creating a warm and inviting ambiance that is perfect for relaxing evenings at home or outdoor gatherings with friends and family.',
            'ingredients' => 'Durable metal, high-quality glass panels, and a powder-coated finish for a sleek and modern look',
            'price' => 15.00,
            'discount' => 0.0,
            'stock' => 10,
            'burn_hours' => 0,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "brown",
            'photo_path' => "images/lantern.jpg",
            'photo_path2' => "images/lantern2.jpg",
            'trending' => false,
        ]);

        Product::create([
            'category_id' => 5,
            'ean_code' => '1234567890123',
            'name' => 'Green Tea Incense Sticks',
            'description' => 'Experience the calming and refreshing aroma of green tea with our premium incense sticks. Each stick is carefully handcrafted using natural ingredients and traditional techniques to provide you with a pure and authentic scent. Made with high-quality green tea leaves, our incense sticks are perfect for creating a peaceful and serene atmosphere in any room. The light and subtle fragrance of green tea will help you relax and unwind after a long day, and can also help to improve focus and mental clarity during meditation and yoga practice. Each package contains 20 incense sticks, providing you with hours of soothing and refreshing aroma. Bring the tranquility and serenity of a Japanese tea ceremony into your home with our green tea incense sticks.',
            'ingredients' => 'Natural bamboo sticks, blend of essential oils and resins',
            'price' => 10.00,
            'discount' => 0.0,
            'stock' => 10,
            'burn_hours' => 1,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "brown",
            'photo_path' => "images/stick.jpg",
            'photo_path2' => "images/stick2.jpg",
            'trending' => false,
        ]);

        Product::create([
            'category_id' => 3,
            'ean_code' => '1234567890123',
            'name' => 'Calming Lemon Oil',
            'description' => 'Create a fresh and invigorating ambiance in your home with our high-quality Lemon Essential Oil. Our oil is carefully crafted from the highest quality lemon peel, using a steam distillation process that ensures the purity and potency of the oil. This powerful essential oil has a crisp, citrusy aroma that is perfect for uplifting your mood and creating an energizing atmosphere. Our lemon essential oil is versatile and can be used in a variety of ways. It can be added to a diffuser to freshen up any room in your home, or added to cleaning products for a natural and effective cleaning solution. You can even add a few drops to your laundry to infuse your clothes with a refreshing lemon scent.',
            'ingredients' => ' 100% pure and natural, with no additives or fillers, vegan and cruelty-free',
            'price' => 12.00,
            'discount' => 10.0,
            'stock' => 10,
            'burn_hours' => 3,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "brown",
            'photo_path' => "images/oil.jpg",
            'photo_path2' => "images/oil2.jpg",
            'trending' => false,
        ]);

        Product::create([
            'category_id' => 4,
            'ean_code' => '1234567890123',
            'name' => 'Relaxing Fig Difuser',
            'description' => 'Experience the enchanting aroma of fresh figs with our luxurious fig diffuser. Expertly crafted with high-quality essential oils, this diffuser brings the natural fragrance of figs into your home or office, creating a soothing and relaxing ambiance that will help you unwind and destress after a long day. The elegant glass vessel features a unique design that complements any decor style, making it a beautiful addition to any room. The natural reeds effortlessly diffuse the scent throughout the room, providing a long-lasting fragrance that will keep your space smelling fresh and inviting for weeks on end.',
            'ingredients' => ' 100% pure and natural, with no additives or fillers, vegan and cruelty-free',
            'price' => 19.00,
            'discount' => 0,
            'stock' => 10,
            'burn_hours' => 5,
            'brand_id' => 1,
            'type_id' => 1,
            'color' => "brown",
            'photo_path' => "images/diffuserp.jpg",
            'photo_path2' => "images/diffuser2.jpg",
            'trending' => false,
        ]);
    }
}
