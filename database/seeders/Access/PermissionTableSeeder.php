<?php

use Carbon\Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionTableSeeder.
 */
class PermissionTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncateMultiple([config('access.permissions_table'), config('access.permission_role_table')]);

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php.
         */

        /**
         * Misc Access Permissions.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-backend';
        $permModel->display_name = 'Dostęp do Systemu';
        $permModel->sort = 1;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Access Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-access-management';
        $permModel->display_name = 'Dostęp do zarządzania Systemem Uprawnień';
        $permModel->sort = 2;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * User Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-user-management';
        $permModel->display_name = 'Dostęp do zarządzania Użytkownikami';
        $permModel->sort = 3;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-active-user';
        $permModel->display_name = 'Dostęp do zarządzania Aktywnymi Użytkownikami';
        $permModel->sort = 4;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-deactive-user';
        $permModel->display_name = 'Dostęp do zarządzania Nieaktywnymi Użytkownikami';
        $permModel->sort = 5;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-deleted-user';
        $permModel->display_name = 'Dostęp do zarządzania Usuniętymi Użytkownikami';
        $permModel->sort = 6;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'show-user';
        $permModel->display_name = 'Zobacz Szczegóły Użytkownika';
        $permModel->sort = 7;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-user';
        $permModel->display_name = 'Utwórz Użytkownika';
        $permModel->sort = 8;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-user';
        $permModel->display_name = 'Edytuj Użytkownika';
        $permModel->sort = 9;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-user';
        $permModel->display_name = 'Usuń Użytkownika';
        $permModel->sort = 10;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'activate-user';
        $permModel->display_name = 'Aktywuj Użytkownika';
        $permModel->sort = 11;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'deactivate-user';
        $permModel->display_name = 'Deaktywuj Użytkownika';
        $permModel->sort = 12;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'login-as-user';
        $permModel->display_name = 'LZaloguj jako Użytkownik';
        $permModel->sort = 13;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'clear-user-session';
        $permModel->display_name = 'Wyczyść Sesję Użytkownika';
        $permModel->sort = 14;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Role Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-role-management';
        $permModel->display_name = 'Dostęp do zarządzania Rolami';
        $permModel->sort = 15;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-role';
        $permModel->display_name = 'Utwórz Rolę';
        $permModel->sort = 16;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-role';
        $permModel->display_name = 'Edytuj Rolę';
        $permModel->sort = 17;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-role';
        $permModel->display_name = 'Usuń Rolę';
        $permModel->sort = 18;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Permission Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-permission-management';
        $permModel->display_name = 'Dostęp do zarządzania Uprawnieniami';
        $permModel->sort = 19;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-permission';
        $permModel->display_name = 'Utwórz Uprawnienie';
        $permModel->sort = 20;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-permission';
        $permModel->display_name = 'Edytuj Uprawnienie';
        $permModel->sort = 21;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-permission';
        $permModel->display_name = 'Usuń Uprawnienie';
        $permModel->sort = 22;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Client Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-client-management';
        $permModel->display_name = 'Dostęp do zarządzania Klientami';
        $permModel->sort = 23;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();
        
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'show-client';
        $permModel->display_name = 'Zobacz Szczegóły Klienta';
        $permModel->sort = 24;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-client';
        $permModel->display_name = 'Utwórz Klienta';
        $permModel->sort = 25;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-client';
        $permModel->display_name = 'Edytuj Klienta';
        $permModel->sort = 26;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'activate-client';
        $permModel->display_name = 'Aktywuj Klienta';
        $permModel->sort = 27;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'deactivate-client';
        $permModel->display_name = 'Deaktywuj Klienta';
        $permModel->sort = 28;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-client';
        $permModel->display_name = 'Usuń Klienta';
        $permModel->sort = 29;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-deleted-client';
        $permModel->display_name = 'Dostęp do zarządzania Usuniętymi Klientami';
        $permModel->sort = 30;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Service Category Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-servicecat-management';
        $permModel->display_name = 'Dostęp do zarządzania Kategoriami Usług';
        $permModel->sort = 31;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-servicecat';
        $permModel->display_name = 'Utwórz Kategorię Usług';
        $permModel->sort = 32;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-servicecat';
        $permModel->display_name = 'Edytuj Kategorię Usług';
        $permModel->sort = 33;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-servicecat';
        $permModel->display_name = 'Usuń Kategorię Usług';
        $permModel->sort = 34;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Producer Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-producer-management';
        $permModel->display_name = 'Dostęp do zarządzania Producentami';
        $permModel->sort = 35;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-producer';
        $permModel->display_name = 'Utwórz Producenta';
        $permModel->sort = 36;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-producer';
        $permModel->display_name = 'Edytuj Producenta';
        $permModel->sort = 37;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-producer';
        $permModel->display_name = 'Usuń Producenta';
        $permModel->sort = 38;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Producer Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-model-management';
        $permModel->display_name = 'Dostęp do zarządzania Modelami';
        $permModel->sort = 35;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-model';
        $permModel->display_name = 'Utwórz Model';
        $permModel->sort = 36;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-model';
        $permModel->display_name = 'Edytuj Model';
        $permModel->sort = 37;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-model';
        $permModel->display_name = 'Usuń Model';
        $permModel->sort = 38;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Task Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-task-management';
        $permModel->display_name = 'Dostęp do zarządzania Zadaniami';
        $permModel->sort = 39;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-task';
        $permModel->display_name = 'Utwórz Zadanie';
        $permModel->sort = 40;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-task';
        $permModel->display_name = 'Edytuj Zadanie';
        $permModel->sort = 41;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-task';
        $permModel->display_name = 'Usuń Zadanie';
        $permModel->sort = 42;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Map.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-map';
        $permModel->display_name = 'Dostęp do Mapy';
        $permModel->sort = 43;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Calendar.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-calendar';
        $permModel->display_name = 'Dostęp do Kalendarza';
        $permModel->sort = 44;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Email Templates.
        
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-email-template';
        $permModel->display_name = 'View Email Templates';
        $permModel->sort = 27;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = Carbon::now();
        $permModel->deleted_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-email-template';
        $permModel->display_name = 'Create Email Templates';
        $permModel->sort = 28;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = Carbon::now();
        $permModel->deleted_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-email-template';
        $permModel->display_name = 'Edit Email Templates';
        $permModel->sort = 29;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = Carbon::now();
        $permModel->deleted_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-email-template';
        $permModel->display_name = 'Delete Email Templates';
        $permModel->sort = 30;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = Carbon::now();
        $permModel->deleted_at = null;
        $permModel->save();
         */
        
        /**
         * Menu
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-menu';
        $permModel->display_name = 'Zarządzanie Menu';
        $permModel->sort = 45;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-menu';
        $permModel->display_name = 'Tworzenie Menu';
        $permModel->sort = 46;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-menu';
        $permModel->display_name = 'Edycja Menu';
        $permModel->sort = 47;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-menu';
        $permModel->display_name = 'Usuwanie Menu';
        $permModel->sort = 48;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Settings.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-settings';
        $permModel->display_name = 'Edytuj Konfigurację';
        $permModel->sort = 49;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $this->enableForeignKeys();
    }
}
