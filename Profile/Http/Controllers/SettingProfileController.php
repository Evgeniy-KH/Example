<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Profile\Entities\City;
use Modules\Profile\Events\{
    UpdatePrivacyEvent,
    ClearIntegrationEvent,
    UpdateUserAvatarEvent,
    UpdateIntegrationEvent,
    UpdateProfileInfoEvent,
    ClearProfilePhoneEvent,
    UpdateProfilePhoneEvent};
use Modules\Profile\Http\Requests\{
    UserAvatarRequest,
    PhoneNumberRequest,
    IntegrationRequest,
    InfoProfileRequest,
    PrivacyNotificationRequest
};

class SettingProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Blade Html
     */
    public function indexPrivacy()
    {
        return view('profile::contents.personal_settings.privacy_and_notifications', ['activeTab' => 'notification']);
    }

    /**
     * Update user data by his privacy and notifications.
     * @param PrivacyNotificationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePrivacyAndNotification(PrivacyNotificationRequest $request)
    {
        return response()->json(['success' => event(new UpdatePrivacyEvent($request->all()['privacySettings']))])
    }


    /**
     * Display a listing of the resource.
     * @return Blade Html
     */
    public function indexIntegration()
    {
        return view('profile::contents.personal_settings.integration', ['activeTab' => 'integration']);
    }


    /**
     * @param IntegrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateIntegration(IntegrationRequest $request)
    {
        return response()->json(['success' => event(new UpdateIntegrationEvent($request->all()))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function clearIntegration(Request $request)
    {
        return response()->json(['success' => event(new ClearIntegrationEvent($request->all()))]);
    }

    /**
     * Display a listing of the resource.
     * @return Blade Html
     */
    public function indexMyAccount()
    {
        return view('profile::contents.personal_settings.my_account', ['activeTab' => 'my_account']);
    }

    /**
     * Update basic profile data.
     * @param InfoProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileInfo(InfoProfileRequest $request)
    {
        return response()->json(['success' => event(new UpdateProfileInfoEvent($request->all()))]);
    }

    /**
     * * Update user avatar.
     * @param UserAvatarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileAvatar(UserAvatarRequest $request)
    {
        $pathNewAvatar = event(new UpdateUserAvatarEvent($request));

        return response()->json(['avatar' => $pathNewAvatar, 'success' => true]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCitiesCountry(Request $request)
    {
        $city = new City;

        return response()->json(['cities' => $city->getCities($request->all())]);
    }

    /**
     * Display a security  profile blade.
     * @return Blade Html
     */
    public function indexSecurity()
    {
        return view('profile::contents.personal_settings.security', ['activeTab' => 'security']);
    }

    /**
     * @param PhoneNumberRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfilePhone(PhoneNumberRequest $request)
    {
        return response()->json(['success' => event(new UpdateProfilePhoneEvent($request->input('phone')))]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearProfilePhone()
    {
        return response()->json(['success' => event(new ClearProfilePhoneEvent())]);
    }
}
