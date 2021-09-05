<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
      $abilities = $request->input('abilities', ['*']);
      if ($abilities && is_string($abilities)) {
          $abilities = explode(',', $abilities);
      }

  $token=    $user->createToken($request->device_name , $abilities );
  //if i want add ip in table access token 
   /*$accessToken = PersonalAccessToken::findToken($token->plainTextToken);
        $accessToken->forceFill([
            'ip' => $request->ip(),
        ])->save();*/

   return response()->json([
       'token'=>$token->plainTextToken,
       'user'=>$user
   ], 200);

    }

    public function destroy(){
        $user=Auth::guard('sanctum')->user();
        //Delete all tokens for user
        $user->tokens()->delete();

        //Delete current token for user

        $user->currentAccessToken()->delete();
    }
}
