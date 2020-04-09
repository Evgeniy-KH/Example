<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Object_;

/**
 * @property array request
 */
class UpdateUserAvatarEvent
{
    use SerializesModels;

    public $request;

    /**
     * Create a new event instance.
     *
     * @param object $request
     */
    public function __construct(object $request)
    {
        $this->request = $request;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
