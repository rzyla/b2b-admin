<?php

namespace App\Services;
use App\Models\Application;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductsService 
{
    public function indexCollapseCards() : array
    {
        return  
        [
            'show_index_search' => false,
            'show_index_attributes' => true,
            'show_index_filters' => true
        ];
    }

    public function grid(Application $application, $language_id)
    {
        $query = Products::select('*');

       /* $results = DB::select( DB::raw("WITH with_product AS
        (
            SELECT DISTINCT pv.product_id, MIN(ps.product_variant_id) AS product_variant_id, MIN(p.group_code) AS group_code_id, ps.producer_id, ps.price
            FROM product_stock ps 
            JOIN product_variant pv ON pv.product_variant_id = ps.product_variant_id 
            JOIN product p ON p.product_id = pv.product_id 
            GROUP BY pv.product_id
        ),
        with_product_translation AS
        (
            SELECT wp.product_id, MIN(product_translation_id) AS product_translation_id
            FROM product_translation pt 
            JOIN with_product wp ON wp.product_id = pt.product_id
            WHERE pt.is_default = 1
            GROUP BY product_id 
            ORDER BY product_id
        ),
        with_product_category AS 
        (
            SELECT wp.product_id, chpv.category_id 
            FROM with_product wp
            LEFT JOIN category_has_product_variant chpv ON chpv.product_variant_id = wp.product_variant_id
        ),
        with_category_translation AS
        (
            SELECT ct.category_id , MIN(ct.category_translation_id) AS category_translation_id 
            FROM category_translation ct 
            JOIN with_product_category wpc ON wpc.category_id = ct.category_id
            WHERE ct.is_default = 1 
            GROUP BY ct.category_id 
        )
        SELECT wp.product_id, pt.name AS product_name, wpc.category_id, ct.name as category_name, wp.group_code_id, pg.name as group_code_name, wp.producer_id, p.name as producer_name, wp.price
        FROM with_product wp 
        LEFT JOIN with_product_translation wpt ON wpt.product_id = wp.product_id
        JOIN product_translation pt ON pt.product_translation_id = wpt.product_translation_id 
        LEFT JOIN with_product_category wpc ON wpc.product_id = wp.product_id
        LEFT JOIN with_category_translation wct ON wct.category_id = wpc.category_id
        JOIN category_translation ct ON ct.category_translation_id = wct.category_translation_id
        LEFT JOIN product_group pg ON pg.code = wp.group_code_id
        LEFT JOIN producer p ON p.producer_id = wp.producer_id") );*/

        /*if(!empty($application->getFilter('search')))
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
        }*/

        return $query->paginate($application->paginate());
    }
}