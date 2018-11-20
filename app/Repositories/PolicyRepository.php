<?php

namespace App\Repositories;

use App\User;

class PolicyRepository
{
    /**
     * Получить все задачи заданного пользователя.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        $policies = $user->policies()->orderBy('created_at', 'asc')->get();
        foreach ($policies as $police) {
            $police->risks;
            $police->travelers;
            $police->countries;
        }
        
        return $policies;
    }
}