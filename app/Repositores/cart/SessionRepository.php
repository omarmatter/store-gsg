<?php

namespace App\Repositores\cart;

use Illuminate\Support\Facades\Session;

class SessionRepository implements CartRepository{
protected $key = 'cart';
public function all(){

    return Session::get($this->key);

}
public function add($item ,$qty=1)
{
    return Session::push($this->key, $item);
}
public function clear()
{
Session::forget($this->key);
}

}

