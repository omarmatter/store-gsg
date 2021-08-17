<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
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
       $cart=$this->cart->all();
        return view('front.cart', [
          'cart'=>$cart ,
          'total'=> $this->cart->total()
    ]);

    }
    public function store(Request $request){

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1', function($attr, $value, $fail) {
                $id = request()->input('product_id');
                $product = Product::find($id);
                if ($value > $product->quantity) {
                    $fail(__('Quantity greater than quantity in stock.'));
                }
            }],
        ]);

            $cart=$this->cart->add($request->post('product_id') , $request->post('quantity',1));
            if ($request->expectsJson()) {
                return $this->cart->all();
            }
       return redirect()->back()->with('success','Product Added to Cart');

        }
}
