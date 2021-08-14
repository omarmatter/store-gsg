<?php

namespace App\Repositores\cart;

use Illuminate\Support\Facades\Cookie;

class CookieRepository implements CartRepository{
    protected $name = 'cart';
    public function all(){

        return Cookie::get($this->name);

    }
    public function add($item)
    {
      $items =$this->all();
      $items[]=$item;

      Cookie::queue($this->name);
    }
    public function clear()
    {
    Cookie::forget($this->name);
    }

    }

