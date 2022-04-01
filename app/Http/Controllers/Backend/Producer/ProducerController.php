<?php

namespace App\Http\Controllers\Backend\Producer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Producer\CreateProducerRequest;
use App\Http\Requests\Backend\Producer\DeleteProducerRequest;
use App\Http\Requests\Backend\Producer\EditProducerRequest;
use App\Http\Requests\Backend\Producer\ManageProducerRequest;
use App\Http\Requests\Backend\Producer\StoreProducerRequest;
use App\Http\Requests\Backend\Producer\UpdateProducerRequest;
use App\Http\Responses\Backend\Producer\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Producer\Producer;
use App\Repositories\Backend\Producer\ProducerRepository;

/**
 * Class ProducerController.
 */
class ProducerController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Producer\ProducerRepository
     */
    protected $producer;

    /**
     * @param \App\Repositories\Backend\Producer\ProducerRepository $producer
     */
    public function __construct(ProducerRepository $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param \App\Http\Requests\Backend\Producer\ManageProducerRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageProducerRequest $request)
    {
        return new ViewResponse('backend.producer.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Producer\CreateProducerRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateProducerRequest $request)
    {
        return new ViewResponse('backend.producer.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Producer\StoreProducerRequest $request
     *
     * @return mixed
     */
    public function store(StoreProducerRequest $request)
    {
        $this->producer->create($request->all());

        return new RedirectResponse(route('admin.producer.index'), ['flash_success' => trans('alerts.backend.producers.created')]);
    }

    /**
     * @param \App\Models\Producer\Producer                           $producer
     * @param \App\Http\Requests\Backend\Producer\EditProducerRequest $request
     *
     * @return \App\Http\Responses\Backend\Producer\EditResponse
     */
    public function edit(Producer $producer, EditProducerRequest $request)
    {
        return new EditResponse($producer);
    }

    /**
     * @param \App\Models\Access\Producer\Producer                      $producer
     * @param \App\Http\Requests\Backend\Producer\UpdateProducerRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Producer $producer, UpdateProducerRequest $request)
    {
        $this->producer->update($producer, $request->all());

        return new RedirectResponse(route('admin.producer.index'), ['flash_success' => trans('alerts.backend.producers.updated')]);
    }

    /**
     * @param \App\Models\Access\Producer\Producer                      $producer
     * @param \App\Http\Requests\Backend\Producer\DeleteProducerRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Producer $producer, DeleteProducerRequest $request)
    {
        $this->producer->delete($producer);

        return new RedirectResponse(route('admin.producer.index'), ['flash_success' => trans('alerts.backend.producers.deleted')]);
    }
}
