<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserInfoProfile extends Model
{

    use Cachable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_users_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'first_name', 'last_name', 'country_id', 'phone', 'city_id', 'steam_id'];

    /**
     * @param int|string $userId
     * @return mixed
     */
    public function getInfoProfile(int $userId)
    {
        return $this->leftJoin('cities', 'profiles_users_info.city_id',  '=', 'cities.id_city')
                    ->leftJoin('countries', 'profiles_users_info.country_id', '=', 'countries.id_country')
                    ->join('users', 'profiles_users_info.user_id', '=', 'users.id')
                    ->join('profiles_users_avatar', 'profiles_users_info.user_id', '=', 'profiles_users_avatar.user_id')
                    ->select('profiles_users_info.first_name', 'profiles_users_info.last_name', 'profiles_users_info.phone',
                             'users.email', 'users.id_custom', 'users.created_at', 'cities.name as city', 'profiles_users_info.country_id',
                            'countries.name as country','users.login', 'users.id_custom', 'profiles_users_avatar.avatar_path')
                    ->where('profiles_users_info.user_id', '=', $userId)
                    ->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateMainInfo(array $data)
    {
        return $this->join('users', 'profiles_users_info.user_id', '=', 'users.id')
                    ->where('users.id', '=', Auth::id())
                    ->update([
                        'profiles_users_info.country_id' => $data['country_id'],
                        'profiles_users_info.first_name' => $data['first_name'],
                        'profiles_users_info.last_name' => $data['last_name'],
                        'profiles_users_info.city_id' => $data['city_id'],
                        'users.id_custom' => $data['id_custom'],
                        'users.login' => $data['login'],
                        'users.email' => $data['email'],
                    ]);
    }

    /**
     * @param string $phone
     * @return mixed
     */
    public function updatePhone(string $phone)
    {
        return $this->where('user_id', '=', Auth::id())->update(['phone' => $phone]);
    }

    /**
     * @return mixed
     */
    public function clearPhone()
    {
        return $this->where('user_id', '=', Auth::id())->update(['phone' => null]);
    }
}
