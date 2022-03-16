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
                "icon":"fa-users",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Access Management",
                "id":6,
                "content":"Access Management",
                "children":[{
                    "view_permission_id":"view-user-management",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.user.index",
                    "name":"User Management",
                    "id":12,
                    "content":"User Management"
                },
                {
                    "view_permission_id":"view-role-management",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.role.index",
                    "name":"Role Management",
                    "id":7,
                    "content":"Role Management"
                },
                {
                    "view_permission_id":"view-permission-management",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.permission.index",
                    "name":"Permission Management",
                    "id":8,
                    "content":"Permission Management"
                }]
            },
            {
                "view_permission_id":"view-menu",
                "icon":"fa-bars",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.menus.index",
                "name":"Menus",
                "id":9,
                "content":"Menus"
            }]';

        $menu = [
            [
                'id'                    => 1,
                'type'                  => 'backend',
                'name'                  => 'Main CRM Menu',
                'items'                 => $sysmenu,
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
        ];

        DB::table(config('access.menus_table'))->insert($menu);
    }
}
