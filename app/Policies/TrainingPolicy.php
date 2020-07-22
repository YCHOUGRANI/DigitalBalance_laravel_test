<?php

namespace App\Policies;

use App\Training;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function view(User $user, Training $training)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function show_s3(User $user, Training $training)
    {
        return $user->role === 'paid' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function update(User $user, Training $training)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function delete(User $user, Training $training)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function restore(User $user, Training $training)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function forceDelete(User $user, Training $training)
    {
        //
    }
}
