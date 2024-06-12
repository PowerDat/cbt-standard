<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('administrator')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role)
    {
        try {
            $user_role_id = $user->roles[0]->id;

            $role = Role::find($user_role_id);
            return $role->hasPermission('view-role');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        try {
            $user_role_id = $user->roles[0]->id;

            $role = Role::find($user_role_id);
            return $role->hasPermission('create-role');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        try {
            $user_role_id = $user->roles[0]->id;

            $role = Role::find($user_role_id);
            return $role->hasPermission('update-role');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role)
    {
        try {
            $user_role_id = $user->roles[0]->id;

            $role = Role::find($user_role_id);
            return $role->hasPermission('delete-role');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
