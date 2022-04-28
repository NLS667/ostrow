<?php

namespace App\Events\Task;

use Illuminate\Queue\SerializesModels;

/**
 * Class TaskCreated.
 */
class TaskCreated
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
