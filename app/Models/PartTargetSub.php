<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartTargetSub extends Model
{
    use HasFactory;

    protected $table = 'part_target_sub';
    protected $primaryKey = 'part_target_sub_id';

    protected $fillable = [
        'part_target_id',
        'part_target_sub_name',
        'part_target_sub_order',
        'part_target_sub_desc',
        'created_by', 
        'updated_by',
    ];

    //1 PartTargetSub มี 1 PartTarget
    public function partTarget()
    {
        return $this->belongsTo(PartTarget::class, 'part_target_id');
    }

}
