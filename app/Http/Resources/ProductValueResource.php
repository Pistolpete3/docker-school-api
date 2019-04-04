<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductValueResource
 *
 * @package App\Http\Resources
 */
class ProductValueResource extends JsonResource
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
            'product_id'    => $this->product_id,
            'product_name'  => $this->product_name,
            'school_id'     => $this->school_id,
            'school_name'   => $this->school_name,
            'value'         => $this->value,
        ];
    }
}
