<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Service\ManageServiceRequest;
use App\Repositories\Backend\Service\ServiceRepository;
use App\Models\Model\Model;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ServiceTableController.
 */
class ServiceTableController extends Controller
{
    protected $services;

    /**
     * @param \App\Repositories\Backend\Service\ServiceRepository $services
     */
    public function __construct(ServiceRepository $services)
    {
        $this->services = $services;
    }

    /**
     * @param \App\Http\Requests\Backend\Service\ManageServiceRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageServiceRequest $request)
    {
        return Datatables::make($this->services->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('client_id', function ($service) {
                return $service->client_id;
            })
            ->addColumn('service_cat_id', function ($service) {
                return $service->service_cat_id;
            })
            ->editColumn('models', function ($service) {
                $devices = json_decode($service->models);
                $result = '';
                for($i=0;$i<count($devices);$i++)
                {
                    $device = Model::where('id', $devices[$i])->first();
                    $result .= $device->serial_number.'<br/>';
                }
                return $result;
            })
            ->addColumn('offered_at', function ($service) {
                if(isset($service->offered_at))
                {
                    return Carbon::parse($service->offered_at)->toDateString();                    
                } else {
                    return 'Nie złożono';
                }
            })
            ->addColumn('signed_at', function ($service) {
                if(isset($service->signed_at))
                {
                    return Carbon::parse($service->signed_at)->toDateString();                    
                } else {
                    return 'Nie podpisano';
                }
            })
            ->addColumn('installed_at', function ($service) {
                if(isset($service->installed_at))
                {
                    return Carbon::parse($service->installed_at)->toDateString();                    
                } else {
                    return 'Nie zainstalowano';
                }
            })
            ->addColumn('created_at', function ($service) {
                return Carbon::parse($service->created_at)->toDateString();
            })
            ->addColumn('deal_amount', function ($service) {
                if(isset($service->deal_amount))
                {
                    return $service->deal_amount;                    
                } else {
                    return '--';
                }
            })
            ->addColumn('deal_advance', function ($service) {
                if(isset($service->deal_advance))
                {
                    $advance = json_decode($service->deal_advance);
                    $adv_sum = 0;
                    if($advance != null)
                        for($i=0;$i<count($advance);$i++)
                        {
                            $adv_sum += $advance[$i];
                        }
                    }
                    return number_format($adv_sum, 2, ".", "");                    
                } else {
                    return '--';
                }
            })
            ->addColumn('actions', function ($service) {
                return $service->action_buttons;
            })
            ->make(true);
    }
}
