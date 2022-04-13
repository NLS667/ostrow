<?php

namespace App\Http\Controllers\Backend\Model;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Model\ManageModelRequest;
use App\Repositories\Backend\Model\ModelRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ModelTableController.
 */
class ModelTableController extends Controller
{
    protected $models;

    /**
     * @param \App\Repositories\Backend\Model\ModelRepository $service
     */
    public function __construct(ModelRepository $models)
    {
        $this->models = $models;
    }

    /**
     * @param \App\Http\Requests\Backend\Model\ManageModelRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageModelRequest $request)
    {
        return Datatables::make($this->models->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('description', function ($model) {
                return $model->description;
            })
            ->addColumn('producer', function ($model) {
                return $model->producer;
            })
            ->addColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($model) {
                if(isset($model->updated_at))
                {
                    return Carbon::parse($model->updated_at)->toDateString();                    
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($model) {
                return $model->action_buttons;
            })
            ->make(true);
    }
}
