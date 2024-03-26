<?php

namespace App\Models;

use App\Models\Part;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartTarget extends Model
{
    use HasFactory;

    protected $table = 'part_target';
    protected $primaryKey = 'part_target_id';

    //1 part_target มี 1 part

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
