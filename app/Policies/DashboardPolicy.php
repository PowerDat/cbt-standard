<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class DashboardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Role $role)
    {

    }
}
