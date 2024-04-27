<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalTransaction extends Model
{
    use HasFactory;

    protected $table = 'appraisal_transaction';
    protected $primaryKey = 'appraisal_transaction_id';
}
