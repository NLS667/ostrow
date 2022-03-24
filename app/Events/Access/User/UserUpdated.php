<?php

namespace App\Events\Access\User;

use App\Models\Access\User\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class UserUpdated.
 */
class UserUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        \Log::error("UserUpdated event fired.");
        $this->user = $user;
    }
}
