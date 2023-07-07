<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class BannersController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->init();
    }
}