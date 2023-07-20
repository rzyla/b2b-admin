<?php

namespace App\Services;

use App\Models\Filter;
use App\Models\Pages;

class PagesService 
{
    public function indexInitShow() : array
    {
        return  
        [
            'search' => false,
            'filter' => true
        ];
    }

    public function editInitShow() : array
    {
        return  
        [
            'basic' => false,
            'details' => false,
            'meta' => true,
            'edit' => true
        ];
    }
    
    public function grid(Filter $filter, int $pager_size)
    {
        $query = Pages::select('admin_pages.*', 'language.name as language')
            ->join('language', 'admin_pages.language_id', '=', 'language.language_id');

        if(!empty($filter->getFilter('search')))
        {
            $query->where('symbol', 'like', '%' . $filter->getFilter('search') . '%')
                ->orWhere('title', 'like', '%' . $filter->getFilter('search') . '%');
        }

        if(!empty($filter->getFilter('language')))
        {
            $query->where('admin_pages.language_id', $filter->getFilter('language'));
        }

        if(!is_null($filter->getFilter('published')))
        {
            $query->where('published', $filter->getFilter('published'));
        }

        if(!empty($filter->getOrderBy()))
        {
            $query->orderBy($filter->getOrderBy(), $filter->getOrderDir());
        }

        return $query->paginate($pager_size);
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