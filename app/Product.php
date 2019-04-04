<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_products')->withPivot('price');
    }

    public static function findBySchoolCount(int $count = null)
    {
        if (true == $count) {
            return Product::with('schools')
                ->has('schools', '>', $count)
                ->get();
        }

        return Product::all();
    }



    public static function findByValue(float $value)
    {
        $product = Product::first();
        return $product->schools->map(function ($productSchool) use ($product){
            return [
                'school_id'     => $productSchool->id,
                'school_name'   => $productSchool->name,
                'product_id'    => $product->id,
                'product_name'  => $product->name,
                'value'         => $productSchool->pivot->price/$productSchool->circulation,
            ];
        });

        //return Product::with('schools')->get()->map(function (Product $product){
        //    $product->schools->map(function ($school) use ($product) {
        //        return
        //    })
        //    return [
        //        'school_id' => $product->
        //        'school_name',
        //        'product_id',
        //        'product_name',
        //        'value'
        //    ];
        //});
    }
}
