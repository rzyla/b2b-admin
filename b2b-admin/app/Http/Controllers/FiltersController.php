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

    public function setFilters($prefix)  
    {
        $request = Request::all();

        if(!empty($request['filters']))
        {
            foreach($request['filters'] as $key => $value)
            {
                $this->application->filters->add($prefix, $key, $value);
            }
        }

        return back();
    }

    public function clearFilters($prefix)
    {
        $this->application->filters->clear($prefix);

        return back();
    }

    public function setOrderBy($prefix, ?string $orderBy = null, ?string $orderDir = null)
    {
        $this->application->setOrderBy($prefix, $orderBy);
        $this->application->setOrderDir($prefix, $orderDir);

        return back();
    }
}
