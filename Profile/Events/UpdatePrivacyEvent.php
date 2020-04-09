<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;

/**
 * @property array dataPrivacy
 */
class UpdatePrivacyEvent
{
    use SerializesModels;

    public $dataPrivacy;

    /**
     * Create a new event instance.
     *
     * @param array $dataPrivacy
     */
    public function __construct(array $dataPrivacy)
    {
        $this->dataPrivacy = $dataPrivacy;
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
