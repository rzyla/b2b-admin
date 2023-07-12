<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Pages;

class PagesService 
{
    public function grid(Application $application)
    {
        $query = Pages::select('admin_pages.*', 'language.name as language')
            ->join('language', 'admin_pages.language_id', '=', 'language.language_id');

        if(!empty($application->getFilter('search')))
        {
            $query->where('symbol', 'like', '%' . $application->getFilter('search') . '%')
                ->orWhere('title', 'like', '%' . $application->getFilter('search') . '%');
        }

        if(!empty($application->getFilter('language')))
        {
            $query->where('admin_pages.language_id', $application->getFilter('language'));
        }

        if(!is_null($application->getFilter('published')))
        {
            $query->where('published', $application->getFilter('published'));
        }

        if(!empty($application->getOrderBy()))
        {
            $query->orderBy($application->getOrderBy(), $application->getOrderDir());
        }

        return $query->paginate($application->paginate());
    }

    public function getPage($id) : Pages
    {
        return Pages::where('id', $id)->first();
    }

    public function getPageBySymbolLanguageId($symbol, $language_id) : Pages
    {
        return Pages::where('symbol', $symbol)
            ->where('language_id', $language_id)
            ->first();
    }

    public function createPage(array $input) : Pages
    {
        return Pages::create($input);
    }

    public function updatePage(array $input, $id) : Pages
    {
        $page = Pages::where('id', $id)->first();
        $page->update($input);

        return $page;
    }

    public function deletePage($id)
    {
        $page = Pages::find($id);
        $page->delete();
    }

    public function validationMessages() : array
    {
        return 
        [
            'symbol.required' => __('view.validation.required.symbol'),
            'symbol.unique' => __('view.validation.unique.symbol'),
            'title.required' => __('view.validation.required.title'),
            'language_id.required' => __('view.validation.required.language_id'),
        ];
    }
}