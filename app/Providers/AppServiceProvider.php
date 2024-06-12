<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // $menus = DB::select("
        // SELECT 
        //     menu_order
        //     , menu_name
        //     , menu_route 
        //     , sub_menu_order
        //     , sub_menu_name
        //     , sub_menu_route
        // FROM menu 
        // LEFT JOIN sub_menu ON menu.menu_id = sub_menu.menu_id
        // WHERE menu_status = 'Y' 
        // ORDER BY menu_order asc
        // ");
        $menus = Menu::where('menu_status', 'Y')->orderBy('menu_order', 'asc')->get();
        // var_dump((object)$menus);
        
        view()->share('menus', $menus);
    }
}
