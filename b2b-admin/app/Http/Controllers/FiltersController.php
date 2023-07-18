<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Request;

class FiltersController extends Controller
{
    protected Application $application;

    function __construct()
    {
        $this->application = new Application();
    }

    public function setFilters(string $prefix, string $redirect = 'back')  
    {
        $request = Request::all();
        
        if(!empty($request['filters']))
        {
            foreach($request['filters'] as $key => $value)
            {
                $this->application->filters->set($prefix, $key, $value, 'filters');
            }
        }

        if($redirect == 'back')
        {
            return back();
        }
    }

    public function setAtributeFilter(string $prefix)  
    {
        $request = Request::all();
        
        if(!empty($request['filters']))
        {
            foreach($request['filters'] as $key)
            {
                $this->application->filters->set($prefix, $key, null, 'attributes');
            }
        }

        return back();
    }

    public function setOrderBy($prefix, ?string $orderBy = null, ?string $orderDir = null)
    {
        $this->application->setOrderBy($prefix, $orderBy);
        $this->application->setOrderDir($prefix, $orderDir);

        return back();
    }
}
