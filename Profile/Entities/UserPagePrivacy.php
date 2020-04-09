<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserPagePrivacy extends Model
{
    use Cachable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_users_page_privacy';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'privacy_id', 'status'];


//    public function updatePolicy($privacyId,$statusId)
//    {
//        return $this->where('user_id', '=', Auth::id())
//                    ->where('privacy_id', '=', $privacyId)
//                    ->update(['status' => $statusId]);
//    }

    /**
     * @return mixed
     */
    public  function  getUserPolicyStatus()
    {
        return $this->join('profiles_type_privacy_users', 'profiles_users_page_privacy.privacy_id', '=', 'profiles_type_privacy_users.id')
                    ->where('profiles_users_page_privacy.user_id', '=', Auth::id())
                    ->get();
    }

    /**
     * @param $type
     * @param $status
     * @return mixed
     */
    public function updatePolicy(string $type, int $status)
    {
        return $this->join('profiles_type_privacy_users', 'profiles_users_page_privacy.privacy_id', '=', 'profiles_type_privacy_users.id')
                    ->where('user_id', '=', Auth::id())
                    ->where('profiles_type_privacy_users.type_privacy', '=', $type)
                    ->update(['profiles_users_page_privacy.status' => $status]);
    }

    /**
     * @param int $userId
     * @param string $typePrivacy
     * @return mixed
     */
    public function getPrivacy(int $userId, string $typePrivacy)
    {
        return $this->join('profiles_type_privacy_users', 'profiles_users_page_privacy.privacy_id', '=', 'profiles_type_privacy_users.id')
                    ->where('profiles_type_privacy_users.type_privacy', '=', $typePrivacy)
                    ->where('user_id', '=', $userId);
    }
}
