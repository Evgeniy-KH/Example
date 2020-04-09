<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;

/**
 * @property string phone
 */
class UpdateProfilePhoneEvent
{
    use SerializesModels;

    public $phone;

    /**
     * Create a new event instance.
     *
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
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
