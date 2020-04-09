<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;

/**
 * @property array dataProfile
 */
class UpdateProfileInfoEvent
{
    use SerializesModels;

    public $dataProfile;

    /**
     * Create a new event instance.
     *
     * @param array $dataPrivacy
     */
    public function __construct(array $data)
    {
        $this->dataProfile = $data;
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
