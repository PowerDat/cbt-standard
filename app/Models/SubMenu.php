<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubMenu extends Model
{
    use HasFactory;

    protected $table = 'sub_menu';
    protected $primaryKey = 'sub_menu_id';

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
