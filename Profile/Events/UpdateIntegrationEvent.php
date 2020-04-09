<?php

namespace Modules\Profile\Events;

use Illuminate\Queue\SerializesModels;

/**
 * @property array dataIntegration
 */
class UpdateIntegrationEvent
{
    use SerializesModels;


    public $dataIntegration;

    /**
     * Create a new event instance.
     *
     * @param array $dataIntegration
     */
    public function __construct(array $dataIntegration)
    {
        $this->dataIntegration = $dataIntegration;
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
