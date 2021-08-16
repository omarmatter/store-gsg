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

      Cookie::queue($this->name ,$items ,60 * 24* 30 ); // 60 * 24* 30  The  time for Expired = 1 month
    }
    public function clear()
    {
    Cookie::queue($this->name ,'', -60 );
    }

    }

