<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::active()->paginate();
        return view('front.products.index', [
            'products' => $products,

        ]);
    }

    public function show($slug){
        $product = Product::where('slug', '=', $slug)->firstOrFail();
        return view('front.products.show', [
            'product' => $product,
        ]);
}
}
