<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scent extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'scents';

    protected $fillable = [
        'name',
        'img',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'scent_families');
    }
}
