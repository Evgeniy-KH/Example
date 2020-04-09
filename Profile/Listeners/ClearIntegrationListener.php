<?php

namespace Modules\Profile\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\{
    UserIntegration,
    TypeIntegration
};
use Modules\Profile\Events\ClearIntegrationEvent;

/**
 * @property UserIntegration userIntegration
 * @property TypeIntegration typeIntegration
 */
class ClearIntegrationListener
{
    private $userIntegration;
    private $typeIntegration;

    /**
     * Create the event listener.
     *
     * @param UserIntegration $userIntegration
     * @param TypeIntegration $typeIntegration
     */
    public function __construct(UserIntegration $userIntegration, TypeIntegration $typeIntegration)
    {
        $this->userIntegration = $userIntegration;
        $this->typeIntegration = $typeIntegration;
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ClearIntegrationEvent $event)
    {
        $idIntegration = $this->typeIntegration->getIntegrationId($event->dataIntegration['type_integration'])->id;

        return $this->userIntegration->clearIntegration($idIntegration);
    }
}
