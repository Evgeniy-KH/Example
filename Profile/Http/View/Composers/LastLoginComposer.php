<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\{
    UserLastLogin
};

class LastLoginComposer
{
    /**
     * The Country model implementation.
     *
     * @var UserLastLogin
     */
    protected $userLastLogin;

    /**
     * Create a new avatar composer.
     *
     * @param UserLastLogin $userLastLogin
     */
    public function __construct(UserLastLogin $userLastLogin)
    {
        $this->userLastLogin = $userLastLogin;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('lastLogin', $this->userLastLogin->getLastLogin(Auth::id())->latest()->limit(5)->get());
    }
}