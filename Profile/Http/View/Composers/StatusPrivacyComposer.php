<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Entities\StatusTypePrivacy;


class StatusPrivacyComposer
{
    /**
     * The StatusTypePrivacy model implementation.
     *
     * @var StatusTypePrivacy
     */
    protected $statusTypePrivacy;

    /**
     * Create a new avatar composer.
     *
     * @param StatusTypePrivacy $statusTypePrivacy
     */
    public function __construct(StatusTypePrivacy $statusTypePrivacy)
    {
        // Dependencies automatically resolved by service container...
        $this->statusTypePrivacy = $statusTypePrivacy;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('statusesTypePrivacy', $this->statusTypePrivacy->getStatusesForTypePrivacy()->get()->groupBy('type_privacy'));
    }
}