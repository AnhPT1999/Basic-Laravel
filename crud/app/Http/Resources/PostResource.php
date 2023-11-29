<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return is_array($this->resource)
            ? $this->resource
            : $this->resource->toArray();

    }

//    public function toArray(Request $request): array
//    {
//        return parent::toArray($request);
//    }
}
