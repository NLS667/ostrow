<?php

namespace App\Events\TaskType;

use App\Models\TaskType\TaskType;
use Illuminate\Queue\SerializesModels;

/**
 * Class TaskTypeUpdated.
 */
class TaskTypeUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $taskType;

    /**
     * @param $taskType
     */
    public function __construct(TaskType $taskType)
    {
        $this->taskType = $taskType;
    }
}
