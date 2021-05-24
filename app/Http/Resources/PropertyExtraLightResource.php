<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class PropertyExtraLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => ucfirst(Str::limit($this->name,8,'')),
            'icon' => $this->icon,
            'thumb' => $this->image ? $this->imageThumbLink : null,
            'on_home' => $this->on_home,
            'valueDisplay' => $this->is_checkbox ? ($this->value ? trans('general.available') : trans('general.not_available')) : $this->value,
            'value' => $this->value,
        ];
    }
}
