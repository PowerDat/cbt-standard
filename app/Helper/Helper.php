<?php 

namespace App\Helper;

use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function getRoleName()
    {
        $id = Auth::user()->id;
        $user_role = UserRole::where('user_id', $id)->get();
        $role = Role::select('name')->where('id', $user_role[0]->role_id)->get();
        $role_name = $role[0]->name;

        return $role_name;
    }

    public static function getRoleId()
    {
        $id = Auth::user()->id;
        $user_role = UserRole::where('user_id', $id)->get();
        $role_id = $user_role[0]->role_id;

        return $role_id;
    }
}

?>