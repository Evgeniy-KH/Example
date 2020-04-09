<?php

namespace Modules\Profile\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\{
    City,
    UserInfoProfile
};
use Modules\Profile\Events\UpdateProfileInfoEvent;

class ChangeProfileInfoListener
{
    /**
     * @var City
     */
    private $city;
    /**
     * @var UserInfoProfile
     */
    private $userInfoProfile;

    /**
     * Create the event listener.
     *
     * @param City $city
     * @param UserInfoProfile $userInfoProfile
     */
    public function __construct(UserInfoProfile $userInfoProfile, City $city)
    {
        $this->city = $city;
        $this->userInfoProfile = $userInfoProfile;
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateProfileInfoEvent $event)
    {
        $event->dataProfile['city_id'] = $this->city->getCity($event->dataProfile['country_id'], $event->dataProfile['city'])->first()->id_city;
        unset($event->dataProfile['city']);

        return $this->userInfoProfile->updateMainInfo($event->dataProfile);
    }
}
