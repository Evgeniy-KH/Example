<?php

namespace Modules\Profile\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\{
    UserAvatar,
    UserImageDirectory
};
use Modules\Profile\Events\UpdateUserAvatarEvent;

/**
 * @property UserImageDirectory userImageDirectory
 * @property UserAvatar userAvatar
 */
class ChangeUserAvatarListener
{
    public $userAvatar;
    public $userImageDirectory;

    /**
     * Create the event listener.
     *
     * @param UserAvatar $userAvatar
     * @param UserImageDirectory $userImageDirectory
     */
    public function __construct(UserAvatar $userAvatar, UserImageDirectory $userImageDirectory)
    {
        $this->userAvatar = $userAvatar;
        $this->userImageDirectory = $userImageDirectory;
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateUserAvatarEvent $event)
    {
        $userPath = $this->userImageDirectory->getPathImageDirectory();
        $path = $event->request->file('avatar')->store($userPath . '/avatar');
        $path = str_replace('public/', 'storage/', $path);
        $this->userAvatar->updateAvatar($path);

        return $path;
    }
}
