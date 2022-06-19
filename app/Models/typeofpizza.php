<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeofpizza extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'ingredients',
        'image',
        'is_active',
    ];

    
    public function toppings()
    {
        return $this->hasMany(Topping::class, 'product_id');
    }
}
