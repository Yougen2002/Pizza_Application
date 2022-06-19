<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'user_id',
        'deal_id',
        'status',
        'payment_status',
        'delivery_method',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'phone',
        'mobile',
        'discount',
        'total',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }


}
