<?php

namespace App\Repositores\cart;

interface  CartRepository{

public function all();
public function add($item);
public function clear();

}

