<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected  $fillable = [
'name',
'code',
'type',
'size',
'value',
'price_type',
'price_value',
'description',
'is_active',

       ];
}
