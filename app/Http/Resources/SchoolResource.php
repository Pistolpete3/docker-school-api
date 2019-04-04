<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
            'name'          => $this->name,
            'city'          => $this->city,
            'state'         => $this->state,
            'zip'           => $this->zip,
            'circulation'   => $this->circulation,
            'products'      => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
