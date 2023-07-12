<?php

namespace App\Services;

use App\Models\Languages;

class LanguagesService 
{
    public function getAllLanguages()
    {
        return Languages::select('language_id', 'name')
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->get()
            ->pluck('name', 'language_id');
    }

    public function getLanguageByShortName($shortName) : Languages
    {
        return Languages::whereRaw("lower(shortname) = '" . strtolower($shortName) . "'")
            ->first();
    }
}