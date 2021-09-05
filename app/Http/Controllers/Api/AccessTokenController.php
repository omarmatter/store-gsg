<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AccessTokenController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'username'=>['required'],
            'password'=>['required'],
            'device_name'=>['required']
        ]);
      $user=User::where('email',$request->username)
      ->orWhere('mobile',$request->username)->first();
      if(!$user || Hash::check($request->password, $user->password)){
           return response()->json([
              'message'=>'Invalid username and password '
          ], 401);
      }
  $token=    $user->createAccessToken($request->device_name );

   return response()->json([
       'token'=>$token->plainTextToken,
       'user'=>$user
   ], 200);

    }
}
