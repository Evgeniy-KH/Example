<?php

namespace Modules\Profile\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Events\UpdateProfilePhoneEvent;
use Modules\Profile\Entities\{
    UserInfoProfile
};

/**
 * @property UserInfoProfile userInfoProfile
 */
class ChangeProfilePhoneListener
{
    public $userInfoProfile;

    /**
     * Create the event listener.
     *
     * @param UserInfoProfile $userInfoProfile
     */
    public function __construct(UserInfoProfile $userInfoProfile)
    {
        $this->userInfoProfile = $userInfoProfile;
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateProfilePhoneEvent $event)
    {
        return $this->userInfoProfile->updatePhone($event->phone);
    }
}
