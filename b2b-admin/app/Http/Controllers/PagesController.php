<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Pages;
use App\Services\ConfigurationService;
use App\Services\LanguagesService;
use App\Services\PagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PagesController extends BaseController
{
    function __construct()
    {
        parent::__construct('pages');
    }

    public function index(ConfigurationService $configurationService, PagesService $pagesService, LanguagesService $languagesService)
    {
        $this->init('index');
        $this->filter->initShow($pagesService->indexInitShow());
        $this->application->buttons->add(__('view.button.add'), 'pages.create', $this->buttonTypesEnum->outlinePrimary, $this->buttonsEnum->plus);

        $grid = $pagesService->grid($this->filter, $configurationService->getpaginationSize());
        
        return view('pages.index')
            ->with('application', $this->application)
            ->with('filter', $this->filter)
            ->with('grid', $grid)
            ->with('languages', $languagesService->getAllLanguages());
    }

    public function create(LanguagesService $languagesService, PagesService $pagesService)
    {
        $this->init('edit');
        $this->filter->initShow($pagesService->editInitShow());
        $this->application->breadcrumb->add(__('view.breadcrumb.page.create'), 'pages.create', []);
        $this->application->setTitle(__('view.breadcrumb.page.create'));

        return view('pages.create')
            ->with('application', $this->application)
            ->with('filter', $this->filter)
            ->with('languages', $languagesService->getAllLanguages());
    }

    public function store(Request $request, PagesService $pagesService)
    {
        $input = $request->all();
        
        $validator = Validator::make($request->all(), 
        [
            'symbol' => ['required', Rule::unique(app(Pages::class)->getTable())],
            'title' => 'required',
            'language_id' => 'required',
        ], 
        $pagesService->validationMessages());
        
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $page = $pagesService->createPage($input);

        return redirect()
            ->route('pages.edit', [$page->id])
            ->with('success', __('view.message.success.add'));
    }

    public function edit(PagesService $pagesService, LanguagesService $languagesService, $id)
    {
        $this->init('edit');
        $this->filter->initShow($pagesService->editInitShow());

        $page = $pagesService->getPage($id);
        $languages = $languagesService->getAllLanguages();
        
        $this->application->breadcrumb->add(__('view.breadcrumb.page.edit'), 'pages.edit', [$page->id]);
        $this->application->setTitle(__('view.breadcrumb.page.edit') . ': '. $page->title);

        return view('pages.edit')
            ->with('application', $this->application)
            ->with('filter', $this->filter)
            ->with('page', $page)
            ->with('languages', $languages);
    }

    public function update(Request $request, PagesService $pagesService, $id)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), 
        [
            'symbol' => ['required', Rule::unique(app(Pages::class)->getTable())->ignore($id)],
            'title' => 'required',
            'language_id' => 'required',
        ], 
        $pagesService->validationMessages());
        
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request);
        }

        $page = $pagesService->updatePage($input, $id);

        return redirect()
            ->route('pages.edit', [$page->id])
            ->with('success', __('view.message.success.edit'));
    }

    public function destroy(PagesService $pagesService, $id)
    {
        $pagesService->deletePage($id);

        return redirect()
            ->route('pages.index')
            ->with('success', __('view.message.success.delete'));
    }
}