<?php

namespace App\Http\Controllers\Backend\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Backend\Note\CreateNoteRequest;
use App\Http\Requests\Backend\Note\DeleteClientRequest;
use App\Http\Requests\Backend\Note\EditClientRequest;
use App\Http\Requests\Backend\Note\StoreClientRequest;
use App\Http\Requests\Backend\Note\UpdateClientRequest;
use App\Http\Responses\Backend\Note\CreateResponse;
use App\Http\Responses\Backend\Note\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Client\Client;
use App\Repositories\Backend\Client\ClientRepository;

/**
 * Class NoteController.
 */
class NoteController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Client\ClientRepository
     */
    protected $clients;
    /**
     * @var \App\Repositories\Backend\Note\NoteRepository
     */
    protected $notes;

    /**
     * @param \App\Repositories\Backend\Client\ClientRepository                   $clients
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    /**
     * @param \App\Http\Requests\Backend\Note\CreateNoteRequest $request
     *
     * @return \App\Http\Responses\Backend\Note\CreateResponse
     */
    public function create(CreateNoteRequest $request)
    {
        return new CreateResponse();
    }

    /**
     * @param \App\Http\Requests\Backend\Client\StoreNoteRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreNoteRequest $request)
    {
        $validated = $request->validated();

        $this->notes->create($request);

        return new RedirectResponse(route('admin.client.index'), ['flash_success' => trans('alerts.backend.notes.created')]);
    }

    /**
     * @param \App\Models\Note\Note                           $note
     * @param \App\Http\Requests\Backend\Note\EditNoteRequest $request
     *
     * @return \App\Http\Responses\Backend\Note\EditResponse
     */
    public function edit(Note $note, EditNoteRequest $request)
    {
        return new EditResponse($note);
    }

    /**
     * @param \App\Models\Access\Note\Note                             $note
     * @param \App\Http\Requests\Backend\Note\UpdateNoteRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Note $note, UpdateNoteRequest $request)
    {
        $this->notes->update($note, $request);

        return new RedirectResponse(route('admin.client.index'), ['flash_success' => trans('alerts.backend.notes.updated')]);
    }

    /**
     * @param \App\Models\Access\Note\Note                             $note
     * @param \App\Http\Requests\Backend\Note\DeleteNoteRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Note $note, DeleteNoteRequest $request)
    {
        $this->notes->delete($client);

        return new RedirectResponse(route('admin.client.index'), ['flash_success' => trans('alerts.backend.notes.deleted')]);
    }
}
