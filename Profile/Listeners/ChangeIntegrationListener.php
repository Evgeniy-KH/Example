<?php

namespace Modules\Profile\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\{
    UserIntegration,
    TypeIntegration
};
use Modules\Profile\Events\UpdateIntegrationEvent;

/**
 * @property UserIntegration userIntegration
 * @property TypeIntegration typeIntegration
 */
class ChangeIntegrationListener
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
    public function handle(UpdateIntegrationEvent $event)
    {
        $idIntegration = $this->typeIntegration->getIntegrationId($event->dataIntegration['type_integration'])->id;

        return $this->userIntegration->updateOrCreate(['user_id' => Auth::id(), 'type_integration_id' =>  $idIntegration], ['value' => $event->dataIntegration['value']]);
    }
}
