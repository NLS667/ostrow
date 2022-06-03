<?php

namespace App\Http\Controllers\Backend\ServiceCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ServiceCategory\ManageServiceCatRequest;
use App\Repositories\Backend\ServiceCategory\ServiceCategoryRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ServiceCategoryTableController.
 */
class ServiceCategoryTableController extends Controller
{
    protected $serviceCategories;

    /**
     * @param \App\Repositories\Backend\ServiceCategory\ServiceRepository $serviceCategories
     */
    public function __construct(ServiceCategoryRepository $serviceCategories)
    {
        $this->serviceCategories = $serviceCategories;
    }

    /**
     * @param \App\Http\Requests\Backend\ServiceCategory\ManageServiceCatRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageServiceCatRequest $request)
    {
        return Datatables::make($this->serviceCategories->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('short_name', function ($serviceCategory) {
                return $serviceCategory->description;
            })
            ->addColumn('description', function ($serviceCategory) {
                return $serviceCategory->description;
            })
            ->addColumn('clients', function ($serviceCategory) {
                return $serviceCategory->clientCount;
            })
            ->addColumn('created_at', function ($serviceCategory) {
                return Carbon::parse($serviceCategory->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($serviceCategory) {
                if(isset($serviceCategory->updated_at))
                {
                    return Carbon::parse($serviceCategory->updated_at)->toDateString();                    
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($serviceCategory) {
                return $serviceCategory->action_buttons;
            })
            ->make(true);
    }
}
