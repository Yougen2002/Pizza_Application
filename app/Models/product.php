<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'typeofpizza_id',
        'size',
        'price',
        'description',
        'image',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    
    public function typeofpizza()
    {
        return $this->belongsTo(typeofpizza::class, 'typeofpizza_id');
    }
    
    public function toppings()
    {
        return $this->hasMany(Topping::class, 'product_id');
    }

}
