<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\LanguagesService;
use App\Services\PagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PagesApiController extends BaseController
{
    public function get(PagesService $pagesService, LanguagesService $languagesService, string $symbol, string $languageShortName)
    {
        $language = $languagesService->getLanguageByShortName($languageShortName);
        $page = $pagesService->getPageBySymbolLanguageId($symbol, $language['language_id']);
        
        return response()->json($page);
    }
}