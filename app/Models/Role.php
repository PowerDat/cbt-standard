<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //1 Role ก็มีได้หลาย Users → `1 Role belongs to many Users`
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function hasPermission($name)
    {
        return $this->permissions()->where('name', $name)->exists();
    }

}
