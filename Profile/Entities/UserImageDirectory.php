<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserImageDirectory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_users_images_directory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'path_user_images'];

    public $timestamps = false;

    /**
     * @return mixed
     */
    public function getPathImageDirectory()
    {
        return $this->where('user_id', '=', Auth::id())->value('path_user_images');
    }
}
