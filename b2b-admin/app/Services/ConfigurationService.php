<?php

namespace App\Services;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigurationService 
{
    private $keys = ['language_id'];

    public function get() : array
    {
        return Configuration::select('value','key')
            ->get()
            ->pluck('value', 'key')
            ->toArray();
    }

    public function update(Request $request)
    {
        DB::table(app(Configuration::class)->getTable())->delete();

        foreach($request->all() as $key => $value)
        {
            if(in_array($key, $this->keys))
            {
                Configuration::create(['key' => $key, 'value' => $value]);
            }
        }
    }

    public function getLanguageId()
    {
        $configuration = $this->get();

        return array_key_exists('language_id', $configuration) ? $configuration['language_id'] : null;
    }
}