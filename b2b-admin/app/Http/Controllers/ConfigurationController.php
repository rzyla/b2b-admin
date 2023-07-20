<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\BaseController;
use App\Models\Configuration;
use App\Services\ConfigurationService;
use App\Services\LanguagesService;
use Illuminate\Http\Request;

class ConfigurationController extends BaseController
{
    function __construct()
    {
        parent::__construct('configuration');
    }

    public function edit(ConfigurationService $configurationService, LanguagesService $languagesService)
    {
        $this->init('edit');
        $this->filter->initShow($configurationService->editInitShow());

        return view('configuration.edit')
            ->with('application', $this->application)
            ->with('configuration', $configurationService->get())
            ->with('filter', $this->filter)
            ->with('languages', $languagesService->getAllLanguages());
    }

    public function update(Request $request, ConfigurationService $configurationService)
    {
        $configurationService->update($request);

        return redirect()
            ->route('configuration')
            ->with('success', __('view.message.success.edit'));
    }
}