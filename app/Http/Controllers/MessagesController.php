<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function store(Request $request){
$request->validate([
    'message'=>'required'
]);

broadcast(new MessageSent($request->messagem,Auth::user()));

return ;

    }
}
