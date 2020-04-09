<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Profile\Http\View\Composers\{
    AvatarComposer,
    CountriesComposer,
    LastLoginComposer,
    IntegrationComposer,
    ProfileInfoComposer,
    StatusPrivacyComposer,
    StatusSearchTeamComposer,
    UserPrivacyStatusComposer};

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('profile::contents.profile_head_component', StatusSearchTeamComposer::class);
        View::composer('profile::contents.personal_settings.security', LastLoginComposer::class);
        View::composer('profile::contents.personal_settings.integration', IntegrationComposer::class);
        View::composer('profile::contents.personal_settings.privacy_and_notifications', StatusPrivacyComposer::class);
        View::composer('profile::contents.personal_settings.privacy_and_notifications', UserPrivacyStatusComposer::class);
        View::composer(['profile::contents.profile_head_component', 'profile::contents.personal_settings.my_account'], AvatarComposer::class);
        View::composer(['profile::contents.profile', 'profile::contents.personal_settings.my_account', 'profile::contents.personal_settings.security',
                        'profile::contents.profile_head_component'], ProfileInfoComposer::class);
        View::composer(['profile::contents.personal_settings.my_account','profile::contents.personal_settings.security'], CountriesComposer::class);
    }
}
