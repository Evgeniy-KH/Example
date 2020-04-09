<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\UserInfoProfile;


class ProfileInfoComposer
{
    /**
     * The Request class.
     *
     * @var Request
     */
    protected $request;
    /**
     * The UserInfoProfile model implementation.
     *
     * @var UserInfoProfiles
     */
    protected $userInfoProfile;

    /**
     * Create a Profile info composer.
     *
     * @param Request $request
     * @param UserInfoProfile $userInfoProfile
     */
    public function __construct(UserInfoProfile $userInfoProfile, Request $request)
    {
        $this->request = $request;
        $this->userInfoProfile = $userInfoProfile;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $profileInfo = $this->userInfoProfile->getInfoProfile(get_user_id_by_custom_id($this->request->input('id')));
        $profileInfo->hidden_phone = (!empty($profileInfo->phone)) ? substr_replace($profileInfo->phone,' ****** ',3,6) : trans('profile::profile.phone_is_not_specified');

        $view->with('profileInfo', $profileInfo);
    }
}