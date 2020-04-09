<?php

namespace Modules\Profile\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Team\Entities\{
    TeamUserSearchStatus
};

class StatusSearchTeamComposer
{
    /**
     * The Request class.
     *
     * @var Request
     */
    protected $request;
    /**
     * The TeamUserSearchStatus model implementation.
     *
     * @var TeamUserSearchStatus
     */
    protected $teamUserSearchStatus;


    /**
     * Create a status search team composer.
     * @param Request $request
     * @param TeamUserSearchStatus $teamUserSearchStatus
     */
    public function __construct(TeamUserSearchStatus $teamUserSearchStatus, Request $request)
    {
        $this->request = $request;
        $this->teamUserSearchStatus = $teamUserSearchStatus;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('teamSearchStatus', $this->teamUserSearchStatus->getSearchStatus(get_user_id_by_custom_id($this->request->input('id'))));
    }
}