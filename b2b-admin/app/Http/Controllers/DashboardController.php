<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    function __construct()
    {
        parent::__construct('dashboard');
    }

    public function index()
    {
        $this->init('index');
        
        return view('dashboard.index')
            ->with('application', $this->application)
            ->with('filter', $this->filter);
    }
}