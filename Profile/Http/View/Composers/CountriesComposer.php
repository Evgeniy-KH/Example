<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\{
    Country
};

class CountriesComposer
{
    /**
     * The Country model implementation.
     *
     * @var Country
     */
    protected $country;

    /**
     * Create a new avatar composer.
     *
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        // Dependencies automatically resolved by service container...
        $this->country = $country;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countries', $this->country->getCountry());
    }
}