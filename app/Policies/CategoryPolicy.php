<?php

namespace App\Policies;

use App\Models\Cartegory;
use App\Models\User;
use App\Enum\Role;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EDITOR;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EDITOR;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EDITOR;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EDITOR;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cartegory $cartegory): bool
    {
        return $user->role === Role::ADMIN || $cartegory->user_id === $user->id;
    }

   
    public function forceDelete(User $user, Cartegory $cartegory): bool
    {
        return $user->role === Role::ADMIN || $cartegory->user_id === $user->id;
    }

     public function deleteAny(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

   
    public function restoreAny(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EDITOR;
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EDITOR;
    }
}
