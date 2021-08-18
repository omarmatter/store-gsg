<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositores\cart\CartRepository;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    public function create(){
        return view('front.checkout',[
            'cart'=>$this->cart ,
            'user'=>Auth::user(),
            'countries'=>Countries::getNames()

        ]);
    }

    public function store(Request $request){
        $request->validate([
        'billing_name'=>['required' ,'string'],
        'billing_phone'=>'required',
        'billing_email'=>'required|email',
        'billing_address'=>'required',
        'billing_city'=>'required',
        'billing_country'=>'required',

        ]);
        DB::beginTransaction();
           try{
            $request->merge([
                'total' => $this->cart->total(),
            ]);
       $order= Order::create($request->all());

       foreach ($this->cart->all() as $item) {

           $order->items()->create([
            'product_id'=> $item->product_id ,
            'quantity'=>$item->quantity ,
            'price'=> $item->product->price,

           ]);
           DB::commit();
           event(new OrderCreated($order));
           return redirect()->route('orders')->with('success','Order Create');
       }

    }catch(Throwable $ex){
        DB::rollback();
        throw $ex;

    }

    }
}
