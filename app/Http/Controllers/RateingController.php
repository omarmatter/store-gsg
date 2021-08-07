<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\profile;
use App\Models\Rating;
use Illuminate\Http\Request;

class RateingController extends Controller
{
    public function store(Request $request){
$request->validate([
   'rating'=>'required|int|min:1 |max:5'
]);
       $rateing=     Rating::create([
            'rateable_type'=>profile::class,
            'rateable_id'=>$request->post('id'),
            'rating'=>$request->post('rating')
            ]);

            return $rateing;

    }
}
