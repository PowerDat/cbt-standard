<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartIndexQuestion extends Model
{
    use HasFactory;

    protected $table = 'part_index_question';
    protected $primaryKey = 'part_index_question_id';

    protected $fillable = [
        'part_target_sub_id',
        'part_index_question_order',
        'part_index_question_desc',
    ];
}
