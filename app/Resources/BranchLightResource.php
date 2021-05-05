<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->map(function ($b) {
            return [
                'id' => $b->id,
                'name' => $b->name,
                'address' => $b->address,
                'mobile' => $b->mobile
            ];
        });
    }
}
