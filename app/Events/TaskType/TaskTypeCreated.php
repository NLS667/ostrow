<?php

namespace App\Events\TaskType;

use Illuminate\Queue\SerializesModels;

/**
 * Class TaskTypeCreated.
 */
class TaskTypeCreated
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
