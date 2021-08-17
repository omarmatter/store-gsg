<?php

namespace App\Repositores\cart;

use App\Models\Cart;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class DatabaseRepository implements CartRepository{

    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function all()
    {
        if (!$this->items->count()) {
            $this->items = Cart::where('cookie_id', $this->getCookieId())
                ->orWhere('user_id', Auth::id())
                ->get();
        }

        return $this->items;
    }
public function add($item ,$qty=1)
{
    $cart = Cart::updateOrCreate([
        'cookie_id' => $this->getCookieId(),
        'product_id' => ($item instanceof Product)? $item->id : $item,
    ], [
        //'user_id' => Auth::id(),
        // quantity = quantity + 2
        'quantity' => DB::raw('quantity + ' . $qty),
    ]);
}
public function clear()
{
    return Cart::where('cookie_id',$this->getCookieId())
    ->orWhere('user_id',Auth::user()->id)->delete();

}

protected function getCookieId(){
$id= Cookie::get('cart_cookie_id');
if(!$id){
    $id = Str::uuid();
    Cookie::queue('cart_cookie_id',$id ,60*24*30);

}
return $id;
}
public function total()
    {
        $items = $this->all();
        return $items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
    public function quantity()
    {
        $items = $this->all();
        return $items->sum('quantity');
    }
}

