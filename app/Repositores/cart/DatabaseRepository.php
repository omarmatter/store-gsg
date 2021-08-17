<?php

namespace App\Repositores\cart;

use App\Models\Cart;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class DatabaseRepository implements CartRepository{

public function all(){
    return Cart::where('cookie_id',$this->getCookieId())
    ->orWhere('user_id',Auth::user()->id)->get();

}
public function add($item ,$qty=1)
{
Cart::create([
    'id'=>Str::uuid() ,
    'cookie_id'=>$this->getCookieId() ,
    'product'=>($item instanceof product ) ? $item->id : $item ,
    'user_id' => Auth::user()->id,
    'quantity' => $qty
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

}

