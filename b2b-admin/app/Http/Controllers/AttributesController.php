<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class AttributesController extends BaseController
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