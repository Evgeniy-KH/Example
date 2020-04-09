<?php

namespace Modules\Profile\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class City extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * @param array $data
     * @return mixed
     */
    public function getCities(array $data)
    {
        $cities = $this->join('regions', 'cities.id_region', '=', 'regions.id_region')
                        ->select('regions.name as region_name', 'cities.name as cities_name', 'regions.id_region',
                                  'cities.id_city')
                        ->where('cities.id_country', '=', $data['id_country'])
                        ->where('regions.id_country', '=', $data['id_country']);

        if(!empty($data['filter_cities']))
        {
            return $cities->where('cities.name', 'like', '%' . $data['filter_cities'] . '%')->limit(5)->get();
        }

        return $cities->inRandomOrder()->limit(5)->get();
    }

    /**
     * @param int $idCountry
     * @param string $city
     * @return
     */
    public function getCity(int $idCountry, string $city)
    {
        return $this->where('id_country', '=', $idCountry)
                    ->where('name', '=', $city);
    }
}
