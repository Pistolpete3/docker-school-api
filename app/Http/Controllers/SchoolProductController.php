<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\SchoolResource;
use App\Product;
use App\School;

class SchoolProductController extends Controller
{
    /**
     * Retrieve an existing School by id with Products
     * @param \App\School $school
     * @return \App\Http\Resources\SchoolResource
     */
    public function index(School $school): SchoolResource
    {
        return new SchoolResource($school->load('products'));
    }

    /**
     * Add a Product to a School or edit
     * an existing Product's price
     *
     * @param \App\School $school
     * @param \App\Product $product
     * @param \App\Http\Requests\Product\UpdateProductRequest $request
     * @return \App\Http\Resources\SchoolResource
     */
    public function update(
        School $school,
        Product $product,
        UpdateProductRequest $request
    ): SchoolResource
    {
        $school->products()->syncWithoutDetaching([
            $product->id => $request->only('price')
        ]);
        return new SchoolResource($school->load('products'));
    }

    /**
     * Remove a Product from a School
     *
     * @param \App\School $school
     * @param \App\Product $product
     * @return \App\Http\Resources\SchoolResource
     */
    public function destroy(
        School $school,
        Product $product
    ): SchoolResource
    {
        $school->products()->detach($product);
        return new SchoolResource($school->load('products'));
    }
}
