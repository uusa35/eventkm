<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CollectionUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'slug_ar' => 'required|min:3',
            'slug_en' => 'required|min:3',
            'image' => 'image|nullable',
            'order' => 'numeric|nullable',
            'on_home' => 'boolean|nullable',
            'active' => 'boolean|nullable',
        ];
    }
}
