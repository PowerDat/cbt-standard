<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\UserProfile;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //เช็ค role 
    public function hasRole($name) : bool
    {
        return $this->roles()->where('name', $name)->exists();
    }

    //1 User มีได้หลาย Roles → จะได้เป็น `1 User belongs to many Roles`
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

}
