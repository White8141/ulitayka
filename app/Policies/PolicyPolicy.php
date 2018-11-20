<?php

namespace App\Policies;

use App\Policy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PolicyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Определяем, может ли данный пользователь просматривать данный полис
     *
     * @param  User  $user
     * @param  Policy  $policy
     * @return bool
     */
    public function open(User $user, Policy $policy)
    {
        return $user->id === $policy->user_id;
    }

    /**
     * Определяем, может ли данный пользователь редактировать данный полис
     *
     * @param  User  $user
     * @param  Policy  $policy
     * @return bool
     */
    public function edit(User $user, Policy $policy)
    {
        return $user->id === $policy->user_id;
    }

    /**
     * Определяем, может ли данный пользователь удалить данный полис
     *
     * @param  User  $user
     * @param  Policy  $policy
     * @return bool
     */
    public function destroy(User $user, Policy $policy)
    {
        return $user->id === $policy->user_id;
    }
}
