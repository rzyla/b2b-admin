<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class NamesController extends BaseController
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