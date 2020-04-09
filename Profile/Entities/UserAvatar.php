<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserAvatar extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_users_avatar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'avatar_path'];

    /**
     * @param $value
     * @return $this|Model
     */
    public function setCreatedAt($value)
    {
        return $this;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserAvatar($userId)
    {
        return $this->where('user_id', '=', $userId)->value('avatar_path');
    }

    /**
     * @param $path
     * @return mixed
     */
    public function updateAvatar($path)
    {
        return $this->where('user_id', '=', Auth::id())
                    ->update(['avatar_path' => $path]);
    }
}
