<?php

namespace App\Models;

use App\Models\Part;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartType extends Model
{
    use HasFactory;

    protected $table = 'part_type';
    protected $primaryKey = 'part_type_id';

    //1 type มีหลายเกณฑ์
    public function part()
    {
        return $this->hasMany(Part::class, 'part_type_id');
    }


}
