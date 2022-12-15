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
                "view_permission_id":"view-finance-management",
                "icon":"payments",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.finance.index",
                "name":"Finanse",
                "id":3,
                "content":"Finance"
            },
            {
                "view_permission_id":"view-client-management",
                "icon":"face",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.client.index",
                "name":"Klienci",
                "id":4,
                "content":"Clients"
            },
            {
                "view_permission_id":"view-service-management",
                "icon":"settings_suggest",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.service.index",
                "name":"Usługi",
                "id":5,
                "content":"Services"
            },
            {
                "view_permission_id":"view-task-management",
                "icon":"task_alt",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.task.index",
                "name":"Zadania",
                "id":6,
                "content":"Tasks"
            },
            {
                "view_permission_id":"view-device-management",
                "icon":"task_alt",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"admin.device.index",
                "name":"Urządzenia",
                "id":7,
                "content":"Devices"
            },
            {
                "view_permission_id":"view-dict-management",
                "icon":"menu_book",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Słowniki",
                "id":8,
                "content":"Dictionaries",
                "children":[{
                    "view_permission_id":"view-producer-management",
                    "icon":"engineering",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.producer.index",
                    "name":"Producenci",
                    "id":9,
                    "content":"Producers"
                },
                {
                    "view_permission_id":"view-model-management",
                    "icon":"inventory",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.model.index",
                    "name":"Modele Produktów",
                    "id":10,
                    "content":"Product-Models"
                },
                {
                    "view_permission_id":"view-servicecat-management",
                    "icon":"handyman",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.serviceCategory.index",
                    "name":"Kategorie Usług",
                    "id":11,
                    "content":"Service Categories"
                },
                {
                    "view_permission_id":"view-tasktype-management",
                    "icon":"handyman",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.taskType.index",
                    "name":"Rodzaje Zadań",
                    "id":12,
                    "content":"Task Types"
                }]
            }]';

        $sysmenu = '[{
                "view_permission_id":"view-access-management",
                "icon":"security",
                "open_in_new_tab":0,
                "url_type":"route",
                "url":"",
                "name":"Ustawienia Dostępu",
                "id":13,
                "content":"Access-Management",
                "children":[{
                    "view_permission_id":"view-user-management",
                    "icon":"people",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.user.index",
                    "name":"Użytkownicy",
                    "id":14,
                    "content":"User-Management"
                },
                {
                    "view_permission_id":"view-role-management",
                    "icon":"assignment_ind",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.role.index",
                    "name":"Role",
                    "id":15,
                    "content":"Role-Management"
                },
                {
                    "view_permission_id":"view-permission-management",
                    "icon":"assignment_turned_in",
                    "open_in_new_tab":0,
                    "url_type":"route",
                    "url":"admin.access.permission.index",
                    "name":"Uprawnienia",
                    "id":16,
                    "content":"Permission-Management"
                }]
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
