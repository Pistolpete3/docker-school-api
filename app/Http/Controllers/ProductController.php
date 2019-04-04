<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductValueRequest;
use App\Http\Requests\Product\SchoolCountRequest;
use App\Http\Resources\ProductValueResource;
use App\Http\Resources\SchoolCountResource;
use App\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Find existing products by their school count
     *
     * @param \App\Http\Requests\Product\SchoolCountRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function retrieveProductsBySchoolCount(SchoolCountRequest $request): AnonymousResourceCollection
    {
        return SchoolCountResource::collection(
            Product::findBySchoolCount($request->get('count'))
        );
    }

    /**
     *  Find existing products by their school value
     *
     * @param \App\Http\Requests\Product\ProductValueRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function retrieveProductsByValue(ProductValueRequest $request): AnonymousResourceCollection
    {
        return ProductValueResource::collection(
            DB::table('school_products')
                ->select(
                    'school_products.school_id',
                    'schools.name as school_name',
                    'school_products.product_id',
                    'products.name as product_name',
                    'school_products.value'
                )
                ->join('products', 'products.id', '=', 'school_products.product_id')
                ->join('schools', 'schools.id', '=', 'school_products.school_id')
                ->where('value', '>=', $request->has('value') ? $request->get('value') : 0)
                ->get()
        );
    }
}
