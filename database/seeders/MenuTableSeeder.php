<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(config('access.menus_table'))->truncate();

        $sysmenu = '[{
                "view_permission_id":"view-access-management",
                "icon":"security",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Ustawienia Dostępu",
                "id":6,
                "content":"Access-Management",
                "children":[{
                    "view_permission_id":"view-user-management",
                    "icon":"people",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.user.index",
                    "name":"Użytkownicy",
                    "id":12,
                    "content":"User-Management"
                },
                {
                    "view_permission_id":"view-role-management",
                    "icon":"assignment_ind",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.role.index",
                    "name":"Role",
                    "id":7,
                    "content":"Role-Management"
                },
                {
                    "view_permission_id":"view-permission-management",
                    "icon":"assignment_turned_in",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.permission.index",
                    "name":"Uprawnienia",
                    "id":8,
                    "content":"Permission-Management"
                }]
            },
            {
                "view_permission_id":"view-menu",
                "icon":"list",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.menus.index",
                "name":"Ustawienia Menu",
                "id":9,
                "content":"Menus"
            }]';

        $menu = [
            [
                'id'                    => 1,
                'type'                  => 'backend',
                'name'                  => 'Główne Menu Systemowe',
                'items'                 => $sysmenu,
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
        ];

        DB::table(config('access.menus_table'))->insert($menu);
    }
}
