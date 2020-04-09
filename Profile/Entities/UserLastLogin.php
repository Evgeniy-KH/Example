<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserLastLogin extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_last_login';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'ip_address', 'country_code', 'region_name', 'platform', 'browser'];

    /**
     * @param $value
     * @return $this|Model
     */
    public function setUpdatedAt($value)
    {
        return $this;
    }

    /**
     * @param $value
     * @return string
     */
    public function getIpAddressAttribute($value)
    {
        return long2ip($value);
    }

    /**
     * @param $value
     */
    public function setIpAddressAttribute($value)
    {
         $this->attributes['ip_address'] = DB::raw("inet_aton('$value')");
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLastLogin($id)
    {
        return $this->where('user_id', '=', $id);
    }
}
