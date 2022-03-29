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

        $mainmenu = '[{
                "view_permission_id":"view-clients-management",
                "icon":"face",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.client.index",
                "name":"Klienci",
                "id":1,
                "content":"Clients"
            },
            {
                "view_permission_id":"view-services-management",
                "icon":"handyman",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.service.index",
                "name":"Usługi",
                "id":1,
                "content":"Services"
            }]';

        $sysmenu = '[{
                "view_permission_id":"view-access-management",
                "icon":"security",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Ustawienia Dostępu",
                "id":2,
                "content":"Access-Management",
                "children":[{
                    "view_permission_id":"view-user-management",
                    "icon":"people",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.user.index",
                    "name":"Użytkownicy",
                    "id":3,
                    "content":"User-Management"
                },
                {
                    "view_permission_id":"view-role-management",
                    "icon":"assignment_ind",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.role.index",
                    "name":"Role",
                    "id":4,
                    "content":"Role-Management"
                },
                {
                    "view_permission_id":"view-permission-management",
                    "icon":"assignment_turned_in",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.permission.index",
                    "name":"Uprawnienia",
                    "id":5,
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
                "id":6,
                "content":"Menus"
            }]';

        $menu = [
            [
                'id'                    => 1,
                'type'                  => 'backend',
                'name'                  => 'Główne Menu',
                'items'                 => $mainmenu,
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'id'                    => 2,
                'type'                  => 'backend',
                'name'                  => 'Menu Konfiguracyjne',
                'items'                 => $sysmenu,
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],

        ];

        DB::table(config('access.menus_table'))->insert($menu);
    }
}
