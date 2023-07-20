<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\AttributesService;
use App\Services\ConfigurationService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

use App\Models\Application\Filter;

class ProductsController extends BaseController
{
    function __construct()
    {
        parent::__construct('products');
    }

    public function index(AttributesService $attributesService, ConfigurationService $configurationService, 
        ProductsService $productsService, Request $request)
    {
        $this->init('index');
        $this->filter->initShow($productsService->indexInitShow());

        $language_id = $configurationService->getLanguageId();
        $attributes = $this->filter->getAttributes();

       
        $attributes_set = !empty($this->filter->getAttributes()) 
            ? $attributesService->getAllAttributes($language_id, $this->filter->getAttributes()) 
            : [];

   
        

        return view('products.index')
            ->with('application', $this->application)
            ->with('filter', $this->filter)

            ->with('attributes_all', $attributesService->getAllAttributes($language_id, null))
            ->with('attributes_set', $attributes_set)

            ->with('grid', $productsService->grid
                (
                    $this->application, 
                    $configurationService->getLanguageId(), 
                    $configurationService->getpaginationSize()
                )
            );
    }
}