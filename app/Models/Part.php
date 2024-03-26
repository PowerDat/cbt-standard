<?php

namespace App\Models;

use App\Models\PartTarget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Part extends Model
{
    use HasFactory;

    protected $table = 'part';
    protected $primaryKey = 'part_id';

    //one to many 1 part มีหลาย part_target
    public function partTarget()
    {
        return $this->hasMany(PartTarget::class, 'part_id');
    }

}
