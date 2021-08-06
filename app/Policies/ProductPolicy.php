<?php

namespace App\Policies;

use App\Models\User;
use App\Models\product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
       $user->hasAbility('products.view-any');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, product $product)
    {
        $user->hasAbility('products.view');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $user->hasAbility('products.create');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, product $product)
    {
        $user->hasAbility('products.update');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, product $product)
    {
        $user->hasAbility('products.delete');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, product $product)
    {
        //
    }
}
