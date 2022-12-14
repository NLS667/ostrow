<?php

namespace App\Repositories\Backend\Model;

use App\Events\Model\ModelCreated;
use App\Events\Model\ModelDeleted;
use App\Events\Model\ModelUpdated;
use App\Exceptions\GeneralException;
use App\Models\Model\Model;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Producer\ProducerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ModelRepository.
 */
class ModelRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;
    /**
     * @var ModelRepository
     */
    protected $model;

    /**
     * @var ProducerRepository
     */
    protected $producer;


    /**
     * @param ModelRepository $model
     */
    public function __construct(Model $model, ProducerRepository $producer)
    {
        $this->model = $model;
        $this->producer = $producer;
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
                DB::raw('(SELECT COUNT(devices.id) FROM devices WHERE devices.model_id = models.id) AS devices'),
                config('producers.producers_table').'.name as producer',
                config('models.models_table').'.created_at',
                config('models.models_table').'.updated_at',
            ]);
    }

    /**
     * Create Model.
     *
     * @param Model $request
     */
    public function create($request)
    {
        if ($this->query()->where('name', $request['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.models.already_exists'));
        }

        $model = $this->createModelStub($request);
        DB::transaction(function () use ($model) {

            if ($model->save()) {

                event(new ModelCreated($model));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.models.create_error'));
        });
    }

    /**
     * Update Model
     * 
     * @param Model $model
     * 
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($model, $request)
    {
        DB::transaction(function () use ($model, $request) {
            $model->producer_id = $request['producer'];
            if ($model->update($request)) {
                
                $model->save();

                event(new ModelUpdated($model));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.models.update_error'));
        });
    }

    /**
     * Delete Model.
     *
     * @param Model $model
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($model)
    {
        if ($model->delete()) {
            event(new ModelDeleted($model));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.models.delete_error'));
    }

    /**
     * @param  $request
     *
     * @return mixed
     */
    protected function createModelStub($request)
    {
        $model = self::MODEL;
        $model = new $model();
        $model->name = $request['name'];
        $model->description = $request['description'];
        $model->producer_id = $request['producer'];
        $model->created_by = access()->user()->id;

        return $model;
    }

}
