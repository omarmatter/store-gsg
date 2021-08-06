<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\product' => 'App\Policies\ProductPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user,$ability){
         if($user->type =='super-admin'){
             return true ;

         }elseif($user->type=='user');
         return false ;
        });

    //   Gate::define('product.create' ,function($user){
    //         return true;


    //   });
//     foreach(config('abilities') as $key => $value){
//           Gate::define($key ,function($user) use($key) {

//         $roles = Role::whereRaw('roles.id in(Select role_id from role_user where user_id =?)',[
// $user->id
// ])->get();


//         foreach($roles as $role){
//             if(in_array($key ,$role->abilities)){
//                 return true;
//             }
//         }


// });

// }
    }
}
