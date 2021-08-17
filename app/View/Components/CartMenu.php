<?php

namespace App\View\Components;

use App\Repositores\cart\CartRepository;
use Illuminate\View\Component;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart=$cart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
