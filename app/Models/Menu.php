<?php

namespace App\Models;

use App\Models\SubMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'menu_id';

    //1 menu มีหลาย subMenu
    public function submenus()
    {
        return $this->hasMany(SubMenu::class, 'menu_id')->where('sub_menu_status', 'Y')->orderBy('sub_menu_order', 'asc');
    }
}
