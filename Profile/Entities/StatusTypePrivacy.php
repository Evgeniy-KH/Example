<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class StatusTypePrivacy extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_status_type_privacy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'type_privacy_id', 'status_privacy', 'description_status'];

    /**
     * @return mixed
     */
    public function getStatusesForTypePrivacy()
    {
        return $this->join('profiles_type_privacy_users', 'profiles_status_type_privacy.type_privacy_id', '=', 'profiles_type_privacy_users.id')
                    ->select('profiles_status_type_privacy.id', 'profiles_type_privacy_users.type_privacy', 'profiles_status_type_privacy.status_privacy');
    }

}
