<?php

namespace App\Repositories\Backend\Model;

use App\Events\Model\ModelCreated;
use App\Events\Model\ModelDeleted;
use App\Events\Model\ModelUpdated;
use App\Exceptions\GeneralException;
use App\Models\Model\Model;
use App\Repositories\BaseRepository;
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
     * @param ModelRepository $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('models.models_table').'.id',
                config('models.models_table').'.name',
                config('models.models_table').'.description',
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

        //$data = $request->except('services', 'tasks');
        //$services = $request->get('services');
        //$tasks = $request->get('tasks');
        //$client = $this->createClientStub($data);
        DB::transaction(function () use ($request) {

            $model = self::MODEL;
            $model = new $model();
            $model->name = $request['name'];
            $model->description = $request['description'];

            $model->created_by = access()->user()->id;

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

}
