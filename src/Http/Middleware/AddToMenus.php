<?php

namespace ProcessMaker\Package\PackageTraining\Http\Middleware;

use Closure;
use Lavary\Menu\Facade as Menu;


class AddToMenus
{

    public function handle($request, Closure $next)
    {

        // Add a menu option to the top to point to our page

        $menu = Menu::get('topnav');

        $menu->add(__('Ejemplo'), ['route' => 'package.skeleton.tab.index']);
        $menu->add(__('New Index'), ['route' => 'package.training.tab.newindex']);


        // Add a option in the admin menu to point to our page
        $menu = Menu::get('sidebar_admin')->first();

        // Add our menu item to the top nav
        $menu->add(__('Skeleton'), [
            'route' => 'package.skeleton.index',
            'icon' => 'fa-puzzle-piece',
        ]);
        return $next($request);
    }
}
