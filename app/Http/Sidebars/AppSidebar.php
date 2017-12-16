<?php

namespace App\Http\Sidebars;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\SidebarExtender;

class AppSidebar implements SidebarExtender
{
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group('Dashboard', function(Group $group) {

            $group->item('Dashboard', function(Item $item) {
                $route = 'administr.dashboard.index';
                $item->icon('fa fa-dashboard');

                $item->route($route);
            });

            $group->item('Quizzes', function(Item $item) {
                $route = 'quizzes.index';
                $item->icon('fa fa-question');

                $item->route($route, [
                    'sort' => [
                        'ends_at' => 'desc',
                    ]
                ]);
            });

        });

        return $menu;
    }
}