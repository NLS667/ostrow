<?php

namespace App\Repositories\Backend\Producer;

use App\Events\Producer\ProducerCreated;
use App\Events\Producer\ProducerDeleted;
use App\Events\Producer\ProducerUpdated;
use App\Exceptions\GeneralException;
use App\Models\Producer\Producer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProducerRepository.
 */
class ProducerRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Producer::class;
    /**
     * @var ProducerRepository
     */
    protected $producer;

    /**
     * @param ProducerRepository $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        //$models = $this->producer->models()->count();
        return $this->query()
            ->leftJoin('models', 'models.producer_id', '=', 'producers.id')
            ->select([
                config('producers.producers_table').'.id',
                config('producers.producers_table').'.name',
                config('producers.producers_table').'.description',
                config('producers.producers_table').'.created_at',
                config('producers.producers_table').'.updated_at',
                DB::raw('(SELECT COUNT(models.id) FROM models JOIN producers ON models.producer_id = producers.id) AS modelCount'),
            ]);
    }

    /**
     * Create Producer.
     *
     * @param Model $request
     */
    public function create($request)
    {
        if ($this->query()->where('name', $request['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.producers.already_exists'));
        }

        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($request) {

            $producer = self::MODEL;
            $producer = new $producer();
            $producer->name = $request['name'];
            $producer->description = $request['description'];

            $producer->created_by = access()->user()->id;

            if ($producer->save()) {

                event(new ProducerCreated($producer));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.producers.create_error'));
        });
    }

    /**
     * Update Producer
     * 
     * @param Model $producer
     * 
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($producer, $request)
    {
        DB::transaction(function () use ($producer, $request) {
            if ($producer->update($request)) {
                
                $producer->save();

                event(new ProducerUpdated($producer));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.producers.update_error'));
        });
    }

    /**
     * Delete Producer.
     *
     * @param Model $producer
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($producer)
    {
        if ($producer->delete()) {
            event(new ProducerDeleted($producer));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.producers.delete_error'));
    }

}
