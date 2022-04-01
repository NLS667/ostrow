<?php

namespace App\Events\Model;

use Illuminate\Queue\SerializesModels;

/**
 * Class ModelCreated.
 */
class ModelCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $model;

    /**
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
}
