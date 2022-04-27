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
                "view_permission_id":"view-map",
                "icon":"map",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.map.index",
                "name":"Mapa",
                "id":1,
                "content":"Map"
            },
            {
                "view_permission_id":"view-calendar",
                "icon":"event",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.calendar.index",
                "name":"Kalendarz",
                "id":2,
                "content":"Calendar"
            },
            {
                "view_permission_id":"view-clients-management",
                "icon":"face",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.client.index",
                "name":"Klienci",
                "id":3,
                "content":"Clients"
            },
            {
                "view_permission_id":"view-tasks-management",
                "icon":"task_alt",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.task.index",
                "name":"Zadania",
                "id":5,
                "content":"Tasks"
            },  
            {
                "view_permission_id":"view-dict-management",
                "icon":"menu_book",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Słowniki",
                "id":6,
                "content":"Dictionaries",
                "children":[{
                    "view_permission_id":"view-producer-management",
                    "icon":"engineering",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.producer.index",
                    "name":"Producenci",
                    "id":7,
                    "content":"Producers"
                },
                {
                    "view_permission_id":"view-model-management",
                    "icon":"inventory",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.model.index",
                    "name":"Modele Produktów",
                    "id":8,
                    "content":"Product-Models"
                },
                {
                    "view_permission_id":"view-servicecat-management",
                    "icon":"handyman",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.serviceCategory.index",
                    "name":"Kategorie Usług",
                    "id":9,
                    "content":"Service Categories"
                }]
            }]';

        $sysmenu = '[{
                "view_permission_id":"view-access-management",
                "icon":"security",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Ustawienia Dostępu",
                "id":10,
                "content":"Access-Management",
                "children":[{
                    "view_permission_id":"view-user-management",
                    "icon":"people",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.user.index",
                    "name":"Użytkownicy",
                    "id":11,
                    "content":"User-Management"
                },
                {
                    "view_permission_id":"view-role-management",
                    "icon":"assignment_ind",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.role.index",
                    "name":"Role",
                    "id":12,
                    "content":"Role-Management"
                },
                {
                    "view_permission_id":"view-permission-management",
                    "icon":"assignment_turned_in",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.permission.index",
                    "name":"Uprawnienia",
                    "id":13,
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
                "id":14,
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
