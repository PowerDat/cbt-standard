<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalQuestion extends Model
{
    use HasFactory;

    protected $table = 'appraisal_question';
    protected $primaryKey = 'appraisal_question_id';
}
