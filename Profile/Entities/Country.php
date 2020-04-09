<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Country extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->join('profiles_countries_phone_code', 'countries.id_country', '=', 'profiles_countries_phone_code.country_id')
                    ->whereIn('profiles_countries_phone_code.country_id', [1, 2, 22])
                    ->get();
    }

}
