<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'number',
        'user_id',
        'shipping',
        'discound',
        'tax',
        'total',
        'stutas',
        'payment_status',
        'shiping_firstname',
        'shiping_lastname',
        'shiping_email',
        'shiping_phone',
        'shiping_address',
        'shiping_city',
        'shiping_country',
        'shiping_email',
        'billing_firstname',
        'billing_lastname',
        'billing_email',
        'billing_phone',
        'billing_address',
        'billing_email',
        'billing_city',
        'billing_country',
        'notes'
    ];

    public function user(){
        return $this->belongsTo(User::class);

    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function products(){
        return $this->belongsToMany(product::class, 'order_items')
        ->using(OrderItem::class)
        ->as('items')
        ->withPivot(['quantity','price']);

    }
}
