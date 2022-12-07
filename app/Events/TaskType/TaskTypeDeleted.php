<?php

namespace App\Events\TaskType;

use Illuminate\Queue\SerializesModels;

/**
 * Class TaskTypeDeleted.
 */
class TaskTypeDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $taskType;

    /**
     * @param $taskType
     */
    public function __construct($taskType)
    {
        $this->taskType = $taskType;
    }
}
