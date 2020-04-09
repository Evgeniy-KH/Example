<?php

namespace Modules\Profile\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\UserPagePrivacy;
use Modules\Profile\Events\UpdatePrivacyEvent;

class ChangePrivacyListener
{
    private $userPagePrivacy;

    /**
     * Create the event listener.
     *
     * @param UserPagePrivacy $userPagePrivacy
     */
    public function __construct(UserPagePrivacy $userPagePrivacy)
    {
        $this->userPagePrivacy = $userPagePrivacy;
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdatePrivacyEvent $event)
    {
        foreach ($event as $key => $value)
        {
            $this->userPagePrivacy->updatePolicy(key($value), $value[key($value)]);
        }
    }
}
