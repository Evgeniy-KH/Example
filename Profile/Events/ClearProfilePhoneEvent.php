<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;

/**
 * @property array dataPrivacy
 */
class ClearProfilePhoneEvent
{
    use SerializesModels;

    public $dataPrivacy;

    /**
     * Create a new event instance.
     *
     * @param array $dataPrivacy
     */
    public function __construct()
    {

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
