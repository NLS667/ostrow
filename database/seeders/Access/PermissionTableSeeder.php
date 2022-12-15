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
        $permModel->display_name = 'Oglądanie Szczegółów Użytkownika';
        $permModel->sort = 7;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-user';
        $permModel->display_name = 'Tworzenie Użytkownika';
        $permModel->sort = 8;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-user';
        $permModel->display_name = 'Edycja Użytkownika';
        $permModel->sort = 9;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-user';
        $permModel->display_name = 'Usuwanie Użytkownika';
        $permModel->sort = 10;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'activate-user';
        $permModel->display_name = 'Aktywacja Użytkownika';
        $permModel->sort = 11;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'deactivate-user';
        $permModel->display_name = 'Deaktywacja Użytkownika';
        $permModel->sort = 12;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'login-as-user';
        $permModel->display_name = 'Logowanie jako Użytkownik';
        $permModel->sort = 13;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'clear-user-session';
        $permModel->display_name = 'Czyszczenie Sesji Użytkownika';
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
        $permModel->display_name = 'Tworzenie Roli';
        $permModel->sort = 16;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-role';
        $permModel->display_name = 'Edycja Roli';
        $permModel->sort = 17;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-role';
        $permModel->display_name = 'Usuwanie Roli';
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
        $permModel->display_name = 'Tworzenie Uprawnień';
        $permModel->sort = 20;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-permission';
        $permModel->display_name = 'Edycja Uprawnień';
        $permModel->sort = 21;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-permission';
        $permModel->display_name = 'Usuwanie Uprawnień';
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
        $permModel->display_name = 'Oglądanie Szczegółów Klienta';
        $permModel->sort = 24;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-client';
        $permModel->display_name = 'Tworzenie Klienta';
        $permModel->sort = 25;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-client';
        $permModel->display_name = 'Edycja Klienta';
        $permModel->sort = 26;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'activate-client';
        $permModel->display_name = 'Aktywacja Klienta';
        $permModel->sort = 27;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'deactivate-client';
        $permModel->display_name = 'Deaktywacja Klienta';
        $permModel->sort = 28;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-client';
        $permModel->display_name = 'Usuwanie Klienta';
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

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-deactive-client';
        $permModel->display_name = 'Dostęp do zarządzania Nieaktywnymi Klientami';
        $permModel->sort = 31;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Service Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-service-management';
        $permModel->display_name = 'Dostęp do zarządzania Usługami';
        $permModel->sort = 32;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-service';
        $permModel->display_name = 'Tworzenie Usług';
        $permModel->sort = 33;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-service';
        $permModel->display_name = 'Edycja Usług';
        $permModel->sort = 34;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-service';
        $permModel->display_name = 'Usuwanie Usług';
        $permModel->sort = 35;
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
        $permModel->sort = 36;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-servicecat';
        $permModel->display_name = 'Tworzenie Kategorii Usług';
        $permModel->sort = 37;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-servicecat';
        $permModel->display_name = 'Edycja Kategorii Usług';
        $permModel->sort = 38;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-servicecat';
        $permModel->display_name = 'Usuwanie Kategorii Usług';
        $permModel->sort = 39;
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
        $permModel->sort = 40;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-producer';
        $permModel->display_name = 'Tworzenie Producentów';
        $permModel->sort = 41;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-producer';
        $permModel->display_name = 'Edycja Producentów';
        $permModel->sort = 42;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-producer';
        $permModel->display_name = 'Usuwanie Producentów';
        $permModel->sort = 43;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Model Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-model-management';
        $permModel->display_name = 'Dostęp do zarządzania Modelami';
        $permModel->sort = 44;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-model';
        $permModel->display_name = 'Tworzenie Modeli';
        $permModel->sort = 45;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-model';
        $permModel->display_name = 'Edycja Modeli';
        $permModel->sort = 46;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-model';
        $permModel->display_name = 'Usuwanie Modeli';
        $permModel->sort = 47;
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
        $permModel->sort = 48;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-task';
        $permModel->display_name = 'Tworzenie Zadań';
        $permModel->sort = 49;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-task';
        $permModel->display_name = 'Edycja Zadań';
        $permModel->sort = 50;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-task';
        $permModel->display_name = 'Usuwanie Zadań';
        $permModel->sort = 51;
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
        $permModel->sort = 52;
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
        $permModel->sort = 53;
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
        $permModel->sort = 54;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-menu';
        $permModel->display_name = 'Tworzenie Menu';
        $permModel->sort = 55;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-menu';
        $permModel->display_name = 'Edycja Menu';
        $permModel->sort = 56;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-menu';
        $permModel->display_name = 'Usuwanie Menu';
        $permModel->sort = 57;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * History.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-history';
        $permModel->display_name = 'Dostęp do historii zdarzeń';
        $permModel->sort = 58;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Dictionaries.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-dict-management';
        $permModel->display_name = 'Dostęp do Słowników';
        $permModel->sort = 59;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Finance.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-finance-management';
        $permModel->display_name = 'Dostęp do Finansów';
        $permModel->sort = 60;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Notes.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-note';
        $permModel->display_name = 'Tworzenie Notatek';
        $permModel->sort = 61;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-note';
        $permModel->display_name = 'Edycja Notatek';
        $permModel->sort = 62;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-note';
        $permModel->display_name = 'Usuwanie Notatek';
        $permModel->sort = 63;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'activate-task';
        $permModel->display_name = 'Wznawianie Zadań';
        $permModel->sort = 64;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'deactivate-task';
        $permModel->display_name = 'Zakańczanie Zadań';
        $permModel->sort = 65;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Task Type Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-tasktype-management';
        $permModel->display_name = 'Dostęp do zarządzania Rodzajami Zadań';
        $permModel->sort = 66;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'create-tasktype';
        $permModel->display_name = 'Tworzenie Rodzaju Zadań';
        $permModel->sort = 67;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'edit-tasktype';
        $permModel->display_name = 'Edycja Rodzaju Zadań';
        $permModel->sort = 68;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'delete-tasktype';
        $permModel->display_name = 'Usuwanie Rodzaju Zadań';
        $permModel->sort = 69;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        /**
         * Device Management.
         */
        $permission_model = config('access.permission');
        $permModel = new $permission_model();
        $permModel->name = 'view-device-management';
        $permModel->display_name = 'Dostęp do zarządzania Urządzeniami';
        $permModel->sort = 70;
        $permModel->created_by = 1;
        $permModel->updated_by = null;
        $permModel->created_at = Carbon::now();
        $permModel->updated_at = null;
        $permModel->save();

        $this->enableForeignKeys();
    }
}
