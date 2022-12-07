<?php

namespace App\Repositories\Backend\Note;

use App\Exceptions\GeneralException;
use App\Models\Note\Note;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Client\ClientRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class NoteRepository.
 */
class NoteRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Note::class;
    /**
     * @var NoteRepository
     */
    protected $note;

    /**
     * @var ClientRepository
     */
    protected $client;


    /**
     * @param NoteRepository $note
     */
    public function __construct(Note $note, ClientRepository $client)
    {
        $this->note = $note;
        $this->client = $client;
    }

    /**
     * Create Note.
     *
     * @param $request
     */
    public function create($request)
    {
        $note = $this->createNoteStub($request);
        DB::transaction(function () use ($note) {

            if ($note->save()) {

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notes.create_error'));
        });
    }

    /**
     * Update Note
     * 
     * @param Note $note
     * 
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($note, $request)
    {
        $note->content = $request['content'];
        $note->updated_by = access()->user()->id;
        DB::transaction(function () use ($note) {
            if ($note->save()) {
                
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notes.update_error'));
        });
    }

    /**
     * Delete Note.
     *
     * @param Note $note
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($note)
    {
        if ($note->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.notes.delete_error'));
    }

    /**
     * @param  $request
     *
     * @return mixed
     */
    protected function createNoteStub($request)
    {
        $note = self::MODEL;
        $note = new $note();
        $note->content = $request['content'];
        $note->client_id = $request['client_id'];
        $note->created_by = access()->user()->id;

        return $note;
    }

}
