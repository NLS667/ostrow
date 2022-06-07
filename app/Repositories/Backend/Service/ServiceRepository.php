<?php

namespace App\Repositories\Backend\Service;

use App\Events\Service\ServiceCreated;
use App\Events\Service\ServiceDeleted;
use App\Events\Service\ServiceUpdated;
use App\Exceptions\GeneralException;
use App\Models\Service\Service;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ServiceRepository.
 */
class ServiceRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Service::class;
    /**

    /**
     * @param ServiceRepository $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('service_categories', 'service_categories.id', '=', 'services.service_cat_id')
            ->leftJoin('models', 'models.id', '=', 'services.model_id')
            ->leftJoin('clients', 'clients.id', '=', 'services.client_id')
            ->select([
                'services.id',
                'clients.first_name AS client',
                'clients.last_name',
                'service_categories.name AS category',
                'models.name AS model',
                'services.offered_at',
                'services.signed_at',
                'services.installed_at',
                'services.deal_amount',
                'services.deal_advance',
            ]);
    }

    /**
     * Create Service.
     *
     * @param Model $request
     */
    public function create($request)
    {
        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($request) {

            $service = self::MODEL;
            $service = new $service();
            $service->client_id = $request['client_id'];
            $service->service_cat_id = $request['service_cat_id'];
            $service->model_id = $request['model_id'];
            $service->offered_at = $request['offered_at'];
            $service->signed_at = $request['signed_at'];
            $service->installed_at = $request['installed_at'];
            $service->deal_amount = $request['deal_amount'];
            $service->deal_advance = $request['deal_advance'];

            $service->created_by = access()->user()->id;

            if ($service->save()) {

                event(new ServiceCreated($service));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.services.create_error'));
        });
    }

    /**
     * Update Service
     * 
     * @param Model $service
     * 
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($service, $request)
    {
        DB::transaction(function () use ($service, $request) {
            if ($service->update($request)) {
                
                $service->save();

                event(new ServiceUpdated($service));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.services.update_error'));
        });
    }

    /**
     * Delete Service.
     *
     * @param Model $service
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($service)
    {
        if ($service->delete()) {
            event(new ServiceDeleted($service));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.services.delete_error'));
    }

}
