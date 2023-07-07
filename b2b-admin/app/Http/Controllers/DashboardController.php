<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->init();

        return view('dashboard.index')
            ->with('application', $this->application);
    }
}