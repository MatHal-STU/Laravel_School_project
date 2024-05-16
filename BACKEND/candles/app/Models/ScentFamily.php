<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScentFamily extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'scent_families';

    protected $fillable = [
        'scent_id',
        'product_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scent()
    {
        return $this->belongsTo(ScentType::class, 'scent_id');
    }


}
