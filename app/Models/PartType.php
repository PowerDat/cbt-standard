<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartType extends Model
{
    use HasFactory;

    protected $table = 'part_type';
    protected $primaryKey = 'part_id_type';
}
