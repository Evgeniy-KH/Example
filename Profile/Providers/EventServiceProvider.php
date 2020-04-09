<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\Facades\Event;
use Modules\Profile\Events\{
    UpdatePrivacyEvent,
    ClearIntegrationEvent,
    UpdateUserAvatarEvent,
    ClearProfilePhoneEvent,
    UpdateIntegrationEvent,
    UpdateProfileInfoEvent};
use Modules\Profile\Listeners\{
    ChangePrivacyListener,
    ChangeUserAvatarListener,
    ChangeProfileInfoListener,
    ClearIntegrationListener,
    ClearProfilePhoneListener,
    ChangeIntegrationListener,
    ChangeProfilePhoneListener};
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UpdatePrivacyEvent::class => [
            ChangePrivacyListener::class,
        ],
        UpdateProfileInfoEvent::class => [
            ChangeProfileInfoListener::class
        ],
        UpdateUserAvatarEvent::class => [
            ChangeUserAvatarListener::class
        ],
        UpdateProfilePhoneEvent::class => [
            ChangeProfilePhoneListener::class
        ],
        UpdateIntegrationEvent::class => [
            ChangeIntegrationListener::class
        ],
        ClearProfilePhoneEvent::class => [
            ClearProfilePhoneListener::class
        ],
        ClearIntegrationEvent::class => [
            ClearIntegrationListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
