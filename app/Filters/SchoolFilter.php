<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class SchoolFilter
 *
 * @package App\Filters
 */
class SchoolFilter extends AbstractFilter
{
    /**
     * Note: state filter not required, added to
     * show flexibility of filter abstraction
     *
     * @var array $filters
     */
    protected $filters = [
        'id',
        'name',
        'state',
    ];

    /**
     * Filter based on id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function id(int $id): Builder
    {
        return $this->builder->where('id', $id);
    }


    /**
     * Filter based on name
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name(string $name): Builder
    {
        return $this->builder->where('name', $name);
    }

    /**
     * Filter based on state
     *
     * @param $state
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function state(string $state): Builder
    {
        return $this->builder->where('state', $state);
    }
}
