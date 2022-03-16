<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Role\Role;
use App\Models\Device\Device;
use App\Models\Access\User\User;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.index');
    }

    /**
     * This function is used to get permissions details by role.
     *
     * @param Request $request
     */
    public function getPermissionByRole(Request $request)
    {
        if ($request->ajax()) {
            $role_id = $request->get('role_id');
            $rsRolePermissions = Role::where('id', $role_id)->first();
            $rolePermissions = $rsRolePermissions->permissions->pluck('display_name', 'id')->all();
            $permissions = Permission::pluck('display_name', 'id')->all();
            ksort($rolePermissions);
            ksort($permissions);
            $results['permissions'] = $permissions;
            $results['rolePermissions'] = $rolePermissions;
            $results['allPermissions'] = $rsRolePermissions->all;
            echo json_encode($results);
            die;
        }
    }

    /**
     * This function is used to get active devices.
     *
     * @param Request $request
     */
    public function getDevices()
    {
        $devices = Device::all()->count();

        /*
         * pass jsonencode array
         * 
         */
        $passArray['view'] = view('backend.includes.dashboard-widget')
                ->with('counter', $devices)
                ->with('icon', 'icon-bell-55')
                ->with('title', 'Total Devices')
                ->with('color', 'primary')
                ->render();

        echo json_encode($passArray);
        die;
    }


    /**
     * This function is used to get active alarms.
     *
     * @param Request $request
     */
    public function getUsers()
    {
        $users = User::where('deleted_at', NULL)->count();

        /*
         * pass jsonencode array
         * 
         */
        $passArray['view'] = view('backend.includes.dashboard-widget')
                ->with('counter', $users)
                ->with('icon', 'icon-delivery-fast')
                ->with('title', 'Active Users')
                ->with('color', 'info')
                ->render();

        echo json_encode($passArray);
        die;
    }
}
