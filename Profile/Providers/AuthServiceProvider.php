<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Profile\Entities\UserIntegration;
use Modules\Profile\Policies\IntegrationPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('personal-profile', function () {
            if (empty(app(\Illuminate\Http\Request::class)->input('id')))
            {
                return true;
            }

            return (Auth::user()->id_custom == app(\Illuminate\Http\Request::class)->input('id'));
        });

        Gate::define('privacy-main-info', function () {
            $userPolicy = app('Modules\Profile\Entities\UserPagePrivacy')
                            ->getPrivacy(get_user_id_by_custom_id(app(\Illuminate\Http\Request::class)->input('id')), 'basic_profile_information')
                            ->first()
                            ->status;
            
            return permission_info($userPolicy, 'basic_profile_information');
        });
    }
}
