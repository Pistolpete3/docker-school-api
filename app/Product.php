<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_products')->withPivot('price');
    }

    /**
     * @param int|null $count
     * @return \App\Product[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function findBySchoolCount(int $count = null)
    {
        if (true == $count) {
            return Product::with('schools')
                ->has('schools', '>', $count)
                ->get();
        }

        return Product::all();
    }

    /**
     * @param float $value
     * @return mixed
     */
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
    }
}
