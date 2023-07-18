<?php

namespace App\Services;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributesService 
{
    public function getAllAttributes(int $language_id, ?array $array) : array
    {
        $whereQuery = !empty($array) ? " WHERE a.attribute_id IN ( ".implode(',', array_keys($array))." )" : "";

        return DB::select("SELECT DISTINCT a.attribute_id, att.name AS attribute_name
        FROM product_stock ps
        JOIN product_variant_attribute_value pvav on ps.product_variant_id = pvav.product_variant_id
        JOIN attribute_value av on pvav.attribute_value_id  = av.attribute_value_id
        JOIN attribute a on av.attribute_id  = a.attribute_id
        JOIN attribute_translation att on a.attribute_id = att.attribute_id AND att.language_id = $language_id"
        .$whereQuery);
    }
}