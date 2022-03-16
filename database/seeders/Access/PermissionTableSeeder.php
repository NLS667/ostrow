<?php

use Carbon\Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeders;

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
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-backend';
        $viewBackend->display_name = 'Dostęp do Systemu';
        $viewBackend->sort = 1;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
        $permission_model = config('access.permission');
        $viewFrontend = new $permission_model();
        $viewFrontend->name = 'view-frontend';
        $viewFrontend->display_name = 'View Frontend';
        $viewFrontend->sort = 2;
        $viewFrontend->created_by = 1;
        $viewFrontend->updated_by = null;
        $viewFrontend->created_at = Carbon::now();
        $viewFrontend->updated_at = Carbon::now();
        $viewFrontend->deleted_at = null;
        $viewFrontend->save();
        */

        /**
         * Access Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-access-management';
        $viewBackend->display_name = 'Dostęp do zarządzania Systemem Uprawnień';
        $viewBackend->sort = 2;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * User Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-user-management';
        $viewBackend->display_name = 'Dostęp do zarządzania Użytkownikami';
        $viewBackend->sort = 3;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-active-user';
        $viewBackend->display_name = 'Dostęp do zarządzania Aktywnymi Użytkownikami';
        $viewBackend->sort = 4;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-deactive-user';
        $viewBackend->display_name = 'Dostęp do zarządzania Nieaktywnymi Użytkownikami';
        $viewBackend->sort = 5;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-deleted-user';
        $viewBackend->display_name = 'Dostęp do zarządzania Usuniętymi Użytkownikami';
        $viewBackend->sort = 6;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'show-user';
        $viewBackend->display_name = 'Zobacz Szczegóły Użytkownika';
        $viewBackend->sort = 7;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-user';
        $viewBackend->display_name = 'Utwórz Użytkownika';
        $viewBackend->sort = 8;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-user';
        $viewBackend->display_name = 'Edytuj Użytkownika';
        $viewBackend->sort = 9;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-user';
        $viewBackend->display_name = 'Usuń Użytkownika';
        $viewBackend->sort = 10;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'activate-user';
        $viewBackend->display_name = 'Aktywuj Użytkownika';
        $viewBackend->sort = 11;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'deactivate-user';
        $viewBackend->display_name = 'Deaktywuj Użytkownika';
        $viewBackend->sort = 12;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'login-as-user';
        $viewBackend->display_name = 'LZaloguj jako Użytkownik';
        $viewBackend->sort = 13;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'clear-user-session';
        $viewBackend->display_name = 'Wyczyść Sesję Użytkownika';
        $viewBackend->sort = 14;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Role Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-role-management';
        $viewBackend->display_name = 'Dostęp do zarządzania Rolami';
        $viewBackend->sort = 15;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-role';
        $viewBackend->display_name = 'Utwórz Rolę';
        $viewBackend->sort = 16;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-role';
        $viewBackend->display_name = 'Edytuj Rolę';
        $viewBackend->sort = 17;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-role';
        $viewBackend->display_name = 'Usuń Rolę';
        $viewBackend->sort = 18;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Permission Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-permission-management';
        $viewBackend->display_name = 'Dostęp do zarządzania Uprawnieniami';
        $viewBackend->sort = 19;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-permission';
        $viewBackend->display_name = 'Utwórz Uprawnienie';
        $viewBackend->sort = 20;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-permission';
        $viewBackend->display_name = 'Edytuj Uprawnienie';
        $viewBackend->sort = 21;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-permission';
        $viewBackend->display_name = 'Usuń Uprawnienie';
        $viewBackend->sort = 22;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Email Templates.
        
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-email-template';
        $viewBackend->display_name = 'View Email Templates';
        $viewBackend->sort = 27;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-email-template';
        $viewBackend->display_name = 'Create Email Templates';
        $viewBackend->sort = 28;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-email-template';
        $viewBackend->display_name = 'Edit Email Templates';
        $viewBackend->sort = 29;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-email-template';
        $viewBackend->display_name = 'Delete Email Templates';
        $viewBackend->sort = 30;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();
         */
        
        /**
         * Settings.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-settings';
        $viewBackend->display_name = 'Edytuj Konfigurację';
        $viewBackend->sort = 23;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $this->enableForeignKeys();
    }
}
