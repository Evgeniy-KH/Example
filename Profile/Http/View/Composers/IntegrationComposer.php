<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\{
    UserIntegration,
    TypeIntegration
};

class IntegrationComposer
{
    /**
     * The UserIntegration model implementation.
     *
     * @var UserIntegration
     */
    protected $userIntegration;

    /**
     * The TypeIntegration model implementation.
     *
     * @var typeIntegration
     */
    protected $typeIntegration;

    /**
     * Create a new avatar composer.
     *
     * @param UserIntegration $userIntegration
     * @param TypeIntegration $typeIntegration
     */
    public function __construct(UserIntegration $userIntegration, TypeIntegration $typeIntegration)
    {
        $this->userIntegration = $userIntegration;
        $this->typeIntegration = $typeIntegration;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $integrations = $this->typeIntegration->get();
        $userIntegrations = $this->userIntegration->getUserIntegrations()->groupBy('type');
        $userIntegrations = $userIntegrations->map(function ($item, $key) {
            return $item->flatten()->toArray()[0];
        });

        $view->with('userIntegration', $userIntegrations)->with('integrations', $integrations);
    }
}