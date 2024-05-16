<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $table = 'products';


    protected $fillable = [
        'category_id',
        'ean_code',
        'name',
        'description',
        'ingredients',
        'price',
        'burn_hours',
        'discount',
        'stock',
        'brand_id',
        'type_id',
        'color',
        'photo_path',
        'photo_path2',
        'trending',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function scents()
    {
        return $this->belongsToMany(Scent::class, 'scent_families'); 
    }


}
