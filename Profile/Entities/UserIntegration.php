<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserIntegration extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_users_integration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_integration_id', 'user_id', 'value'];

    /**
     * @return mixed
     */
    public function getUserIntegrations()
    {
        return $this->join('profile_types_integration', 'profile_users_integration.type_integration_id', 'profile_types_integration.id')
                    ->where('profile_users_integration.user_id', '=', Auth::id())
                    ->get();
    }

    /**
     * @param int $idIntegration
     * @return mixed
     */
    public function clearIntegration(int $idIntegration)
    {
        return $this->where('user_id', '=', Auth::id())->where('type_integration_id', '=', $idIntegration)->update(['value' => '']);
    }
}
