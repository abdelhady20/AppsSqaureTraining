<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'subcategory_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
