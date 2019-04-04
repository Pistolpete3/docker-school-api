<?php

namespace App;

use App\Filters\SchoolFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class School
 *
 * @package App
 */
class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'city',
        'state',
        'zip',
        'circulation',
    ];

    /**
     * Return product relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'school_products')->withPivot('price');
    }

    /**
     * Configurable school filter builder
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\SchoolFilter $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, SchoolFilter $filters)
    {
        return $filters->apply($query);
    }
}
