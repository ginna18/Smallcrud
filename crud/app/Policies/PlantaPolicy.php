<?php

namespace App\Policies;

use App\Models\planta;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlantaPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Planta  $planta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Planta $planta)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Planta  $planta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, planta $planta){

        //true si el usuario es el creador o registrador de la planta  o tiene uno de los roles 
        return $user->isOwner($planta) || 
               $user->hasRole(['editor','administrador','todopoderoso']);//
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Planta  $planta
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function delete(User $user, planta $planta){
       
        //true si el usuario es el creador o tiene uno de los roles
        return $user->isOwner($planta) || 
               $user->hasRole(['administrador','todopoderoso']);//
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Planta  $planta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, planta $planta){
        //true si el usuario es el creador/registrador de la planta o tiene uno de los roles
        return $user->isOwner($planta)||
               $user->hasRole(['administrador','todopoderoso']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Planta  $planta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, planta $planta)
    {
        //
    }
}
