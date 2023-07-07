<?php

namespace App\Http\Controllers;

use App\Models\Dto\GridDto;
use App\Models\Enums\AlertsTypesEnum;
use App\Models\Enums\ButtonsEnum;
use App\Models\Enums\ButtonTypesEnum;
use App\Models\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected AlertsTypesEnum $alertsTypesEnum;
    protected ButtonsEnum $buttonsEnum;
    protected ButtonTypesEnum $buttonTypesEnum;
    protected Application $application;
    protected GridDto $grid;

    function __construct(?string $prefix = null)
    {
        $this->application = new Application($prefix);
        $this->alertsTypesEnum = new AlertsTypesEnum();
        $this->buttonsEnum = new ButtonsEnum();
        $this->buttonTypesEnum = new ButtonTypesEnum();
        $this->grid = new GridDto();
    }

    protected function init()
    {
        $this->application->InitUser(Auth::user());
        $this->application->InitSessionMessages();
    }
}
