<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SchoolCountResource
 *
 * @package App\Http\Resources
 */
class SchoolCountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id'    => $this->id,
            'product_name'  => $this->name,
            'school_count'  => $this->schools()->count(),
        ];
    }
}
