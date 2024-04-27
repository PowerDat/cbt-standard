<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalScore extends Model
{
    use HasFactory;

    protected $table = 'appraisal_score';
    protected $primaryKey = 'appraisal_score_id';
}
