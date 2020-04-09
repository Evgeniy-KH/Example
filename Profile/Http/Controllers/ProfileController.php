<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Blade Html
     */
    public function index()
    {
        return view('profile::contents.profile', ['personalCabinetTab' => 'main_info']);
    }
}
