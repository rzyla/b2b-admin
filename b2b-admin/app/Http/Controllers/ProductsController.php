<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\AttributesService;
use App\Services\ConfigurationService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends BaseController
{
    function __construct()
    {
        parent::__construct('products');
    }

    public function index(AttributesService $attributesService, ConfigurationService $configurationService, 
        ProductsService $productsService, Request $request)
    {
        $this->init();
        $this->application->initCollapseCards($productsService->indexCollapseCards());
        
        $language_id = $configurationService->getLanguageId();
        $attributes_array = $this->application->getAttributes();
        $attributes_set = !empty($attributes_array) ? $attributesService->getAllAttributes($language_id, $attributes_array) : [];

        $request = session()->all();
        dump($request );
        dump($attributes_array);
        dump($attributes_set);
        

        return view('products.index')
            ->with('application', $this->application)
            ->with('attributes_all', $attributesService->getAllAttributes($language_id, null))
            ->with('attributes_set', $attributes_set)
            ->with('attributes_array', $attributes_array)
            ->with('grid', $productsService->grid($this->application, 1));
    }
}