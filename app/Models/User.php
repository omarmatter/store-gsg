<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function hasAbility($ability)
    {
        $roles = Role::whereRaw('roles.id IN (SELECT role_id FROM role_user WHERE user_id = ?)', [
            $this->id,
        ])->get();
        
        foreach ($roles as $role) {
            if (in_array($ability, $role->abilities)) {
                return true;
            }
        }

        return false;
    }


}
