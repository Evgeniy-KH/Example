<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\{
    UserAvatar
};

class AvatarComposer
{
    /**
     * The Request class.
     *
     * @var Request
     */
    protected $request;
    /**
     * The UserAvatar model implementation.
     *
     * @var UserAvatar
     */
    protected $userAvatar;

    /**
     * Create a new avatar composer.
     *
     * @param Request $request
     * @param UserAvatar $userAvatar
     */
    public function __construct(UserAvatar $userAvatar, Request $request)
    {
        $this->request = $request;
        $this->userAvatar = $userAvatar;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $userId = get_user_id_by_custom_id($this->request->input('id'));
        $view->with('avatar', $this->userAvatar->getUserAvatar($userId))->with('userId', $userId);
    }
}