<?php

namespace App\Events\Task;

use Illuminate\Queue\SerializesModels;

/**
 * Class TaskUpdated.
 */
class TaskUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $task;

    /**
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }
}
