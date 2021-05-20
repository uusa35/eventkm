<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PropertyStore extends FormRequest
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
            'name_ar' => 'required|string|min:2',
            'name_en' => 'required|string|min:2',
            'description_ar' => 'nullable:min:3|max:200|string',
            'description_en' => 'nullable:min:3|max:200|string',
            'image' => 'image|nullable|dimensions:width=150,height:150',
            'icon' => 'nullable|string',
            'order' => 'nullable|numeric',
        ];
    }
}
