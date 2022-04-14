<?php

namespace App\Http\Controllers\Backend\Producer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Producer\ManageProducerRequest;
use App\Repositories\Backend\Producer\ProducerRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ProducerTableController.
 */
class ProducerTableController extends Controller
{
    protected $producers;

    /**
     * @param \App\Repositories\Backend\Producer\ProducerRepository $service
     */
    public function __construct(ProducerRepository $producers)
    {
        $this->producers = $producers;
    }

    /**
     * @param \App\Http\Requests\Backend\Producer\ManageProducerRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageProducerRequest $request)
    {
        return Datatables::make($this->producers->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('description', function ($producer) {
                return $producer->description;
            })
            ->addColumn('modelCount', function ($producer) {
                return $producer->models()->count();
            })
            ->addColumn('created_at', function ($producer) {
                return Carbon::parse($producer->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($producer) {
                if(isset($producer->updated_at))
                {
                    return Carbon::parse($producer->updated_at)->toDateString();                    
                } else {
                    return 'Nigdy';
                }
            })
            ->addColumn('actions', function ($producer) {
                return $producer->action_buttons;
            })
            ->make(true);
    }
}
