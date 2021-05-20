<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CategoryGroupUpdate extends FormRequest
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
            'name_ar' => 'required|min:3|max:100|string',
            'name_en' => 'required|min:3|max:100|string',
            'image' => 'image|nullable|dimensions:width=150,height:150',
            'order' => 'nullable|numeric',
            'properties' => 'array|required'
        ];
    }
}
