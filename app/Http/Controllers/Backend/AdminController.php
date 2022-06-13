<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Role\Role;
use App\Models\Device\Device;
use App\Models\Access\User\User;
use App\Models\Client\Client;
use App\Models\Service\Service;
use App\Models\Task\Task;
use App\Models\ServiceCategory\ServiceCategory;
use Carbon\Carbon as Carbon;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::where('status', 1)->get();
        $data['clientCount'] = $clients->count();

        $new_tasks = Task::where('status', 0)->get();
        $coming_tasks = Task::where('status', 2)->get();
        $overdue_tasks = Task::where('status', 3)->get();
        $data['newTaskCount'] = $new_tasks->count();
        $data['comingTaskCount'] = $coming_tasks->count();
        $data['overdueTaskCount'] = $overdue_tasks->count();

        $map_data = [];
        $map_data['mapMode'] = 'large';
        $map_data['mapHeight'] = 900;
        $map_data['mapZoom'] = 7;        
        $map_data['layers'] = [];

        $serviceCategories = ServiceCategory::all();

        if($serviceCategories->count() > 0)
        {
            foreach($serviceCategories as $category)
            {
                $map_data['layers'][] = (object)[
                    'id' => $category->id,
                    'name' => $category->name,
                    'markers' => [],
                ];
            }
        }

        if($clients->count() > 0)
        {
            foreach($clients as $client)
            {
                $services = Service::where('client_id', $client->id)->get();
                $client_markers = [];

                foreach($map_data['layers'] as $layer){

                    foreach($services as $service){
                        $catid = $service->service_cat_id;
                        if($layer->id == $catid){
                            $layer->markers[]  = (object)[
                                'content' => view('backend.map.popup')->with('client', $client)->render(),
                                'coords' => [$client->adr_lattitude, $client->adr_longitude],
                                'title' => $client->full_name,
                                ];
                            }
                    }
                }
            }  
        }
        return view('backend.index')->with('map_data', $map_data)->with('data', $data);
    }

    /**
     * Used to display form for edit profile.
     *
     * @return view
     */
    public function editProfile(Request $request)
    {
        return view('backend.access.users.profile-edit')
            ->withLoggedInUser(access()->user());
    }

    /**
     * Used to update profile.
     *
     * @return view
     */
    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $userId = access()->user()->id;
        $user = User::find($userId);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->updated_by = access()->user()->id;

        if ($user->save()) {
            return redirect()->route('admin.profile.edit')
                ->withFlashSuccess(trans('labels.backend.profile_updated'));
        }
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
    public function getClients()
    {
        $clients = Client::all()->count();

        /*
         * pass jsonencode array
         * 
         */
        $passArray['view'] = view('backend.includes.dashboard-widget')
                ->with('counter', $clients)
                ->with('icon', 'icon-bell-55')
                ->with('title', 'Total Clients')
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
