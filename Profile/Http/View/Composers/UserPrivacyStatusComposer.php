<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\UserPagePrivacy;


class UserPrivacyStatusComposer
{
    /**
     * The UserPagePrivacy model implementation.
     *
     * @var UserPagePrivacy
     */
    protected $userPagePrivacy;

    /**
     * Create a new avatar composer.
     *
     * @param UserPagePrivacy $userPagePrivacy
     */
    public function __construct(UserPagePrivacy $userPagePrivacy)
    {
        $this->userPagePrivacy = $userPagePrivacy;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $userPolicyStatus = $this->userPagePrivacy->getUserPolicyStatus()->groupBy('type_privacy');
        $userPolicyStatus = $userPolicyStatus->map(function ($item, $key) {
            return $item->flatten()->toArray()[0];
        });

        $view->with('userPolicyStatus', $userPolicyStatus);
    }
}