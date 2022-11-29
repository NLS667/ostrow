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
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('producers', 'models.producer_id', '=', 'producers.id')
            ->select([
                config('models.models_table').'.id',
                config('models.models_table').'.name',
                config('models.models_table').'.description',
                config('models.models_table').'.serial_number',
                config('producers.producers_table').'.name as producer',
                config('models.models_table').'.created_at',
                config('models.models_table').'.updated_at',
            ]);
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
        DB::transaction(function () use ($note, $request) {
            $note->client_id = $request['client_id'];
            if ($note->update($request)) {
                
                $note->save();

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
