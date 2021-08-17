<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    public $incrementing=false;

    protected $keyType='string';

    protected $fillable = [
        'id', 'cookie_id', 'product_id', 'user_id', 'quantity',
    ];

    protected $with = [
        'product',
    ];

    protected static function booted()
    {
        /*
        Events:
        creating, created, updating, updated, saving, saved
        deleting, deleted, restoring, restored
        */
        static::creating(function (Cart $cart) {
            $cart->id = Str::uuid();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

