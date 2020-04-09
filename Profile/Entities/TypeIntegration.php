<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class TypeIntegration extends Model
{
    use Cachable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_types_integration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'description'];

    /**
     * @param string $type
     * @return mixed
     */
    public function getIntegrationId(string $type)
    {
        return $this->where('type', '=', $type)->first();
    }
}
