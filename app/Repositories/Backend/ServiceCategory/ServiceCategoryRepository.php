<?php

namespace App\Repositories\Backend\ServiceCategory;

use App\Events\ServiceCategory\ServiceCategoryCreated;
use App\Events\ServiceCategory\ServiceCategoryDeleted;
use App\Events\ServiceCategory\ServiceCategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\ServiceCategory\ServiceCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ServiceCategoryRepository.
 */
class ServiceCategoryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ServiceCategory::class;

    /**
     * @var Service Model
     */
    protected $model;

    /**
     * @var ServiceRepository
     */
    protected $serviceCategory;

    /**
     * @param ServiceCategoryRepository $serviceCategory
     */
    public function __construct(ServiceCategory $model)
    {
        $this->model = $model;
        //$this->service = $service;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        return $this->query()
            ->leftJoin('service_client', 'service_client.servicecat_id', '=', 'service_categories.id')
            ->select([
                config('service.servicecategory_table').'.id',
                config('service.servicecategory_table').'.name',
                config('service.servicecategory_table').'.description',
                DB::raw('(SELECT COUNT(service_client.id) FROM service_client LEFT JOIN clients ON service_client.client_id = clients.id WHERE service_client.servicecat_id = service_categories.id AND clients.deleted_at IS NULL) AS clientCount'),
                config('service.servicecategory_table').'.created_at',
                config('service.servicecategory_table').'.updated_at',
                DB::raw('GROUP_CONCAT(services.name) as services'),
            ])
            ->groupBy('services.id');
    }

    /**
     * Create ServiceCategory.
     *
     * @param Model $request
     */
    public function create($request)
    {
        if ($this->query()->where('name', $request['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.service_cat.already_exists'));
        }

        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($request) {

            $serviceCategory = self::MODEL;
            $serviceCategory = new $serviceCategory();
            $serviceCategory->name = $request['name'];
            $serviceCategory->description = $request['description'];

            $serviceCategory->created_by = access()->user()->id;

            if ($serviceCategory->save()) {

                event(new ServiceCategoryCreated($serviceCategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.service_cat.create_error'));
        });
    }

    /**
     * @param Model $serviceCategory
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($serviceCategory, $request)
    {
        DB::transaction(function () use ($serviceCategory, $request) {
            if ($serviceCategory->update($request)) {
                
                $serviceCategory->save();

                event(new ServiceCategoryUpdated($serviceCategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.services_cat.update_error'));
        });
    }

    /**
     * Delete Service Category.
     *
     * @param Model $serviceCategory
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($serviceCategory)
    {
        if ($serviceCategory->delete()) {
            event(new ServiceCategoryDeleted($serviceCategory));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.service_cat.delete_error'));
    }

    /**
     * @param $permissions
     * @param string $by
     *
     * @return mixed
     */
    public function getByPermission($permissions, $by = 'name')
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        return $this->query()->whereHas('roles.permissions', function ($query) use ($permissions, $by) {
            $query->whereIn('permissions.'.$by, $permissions);
        })->get();
    }

    /**
     * @param $roles
     * @param string $by
     *
     * @return mixed
     */
    public function getByRole($roles, $by = 'name')
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        return $this->query()->whereHas('roles', function ($query) use ($roles, $by) {
            $query->whereIn('roles.'.$by, $roles);
        })->get();
    }
}
