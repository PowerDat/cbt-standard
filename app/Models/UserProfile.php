<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profile';
    protected $primaryKey = 'user_profile_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
