<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Filter;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Request;

class FiltersController extends Controller
{
    protected Application $application;

    function __construct()
    {
        $this->application = new Application();
    }

    public function setAtributes(string $prefix, string $action, string $key, ?string $value = null)  
    {
        $this->filter = new Filter();
        $this->filter->init($prefix, $action);

        $request = Request::all();
        
        if(!empty($request['attributes']))
        {
            foreach($request['attributes'] as $key)
            {
                $this->filter->setAttribute($key, $value);
            }
        }

        return back();
    }

    public function setFilters(string $prefix, string $action)  
    {
        $this->filter = new Filter();
        $this->filter->init($prefix, $action);

        $request = Request::all();
        
        if(!empty($request['filters']))
        {
            foreach($request['filters'] as $key => $value)
            {
                $this->filter->setFilter($key, $value);
            }
        }

        return back();
    }

    public function setOrderBy(string $prefix, string $action, ?string $orderBy = null, ?string $orderDir = null)
    {
        $this->filter = new Filter();
        $this->filter->init($prefix, $action);
        $this->filter->setOrderBy($orderBy);
        $this->filter->setOrderDir($orderDir);
        
        return back();
    }

    public function setShow(string $prefix, string $action, string $key, ?string $value = null)
    {
        $this->filter = new Filter();
        $this->filter->init($prefix, $action);
        $this->filter->setShow($key, $value == "true" ? true : false);
    }
}
