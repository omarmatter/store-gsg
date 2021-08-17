<?php

namespace App\Http\Controllers;

use App\Repositores\cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
    * @var \App\Repository\cart\CartRepository

    */
    protected $cart;

    public function __construct(CartRepository $cart)
    {
     $this->cart=$cart;
    }
    public function index(){
       return $this->cart->all();

    }
}
