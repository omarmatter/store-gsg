<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function  index(){

    $products = product::latest()->limit(10)->get();
    return view ('home',[
        'products'=>$products
    ]);
   }
}
