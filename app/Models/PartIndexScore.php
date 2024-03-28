<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartIndexScore extends Model
{
    use HasFactory;

    protected $table = 'part_index_score';
    protected $primaryKey = 'part_index_score_id';

    protected $fillable = [
        'part_target_sub_id',
        'part_index_score_order',
        'part_index_score_desc',
    ];
}
