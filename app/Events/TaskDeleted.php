<?php

namespace App\Events;

use App\Task;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskDeleted extends Event implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $teamId;
    public $taskId;

    /**
     * Create a new event instance.
     *
     * @param  int  $teamId
     * @param  int  $taskId
     * @return void
     */
    public function __construct($teamId, $taskId)
    {
        $this->teamId = $teamId;
        $this->taskId = $taskId;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['teams.'.$this->teamId.'.tasks'];
    }
}
