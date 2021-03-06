<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdate extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.dimensions' => trans('message.best_fit', ['width' => '1000 px', 'height' => '1000 px']),
            'max.gt' => trans('general.max_greater_than_min'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'min' => 'numeric|nullable',
            'max' => 'numeric|nullable|required_with:min|gt:min',
            'parent_id' => 'required|integer',
            'description_en' => 'min:3|nullable',
            'description_ar' => 'min:3|nullable',
            'image' => "mimes:jpeg,png,jpg,gif|nullable|dimensions:width=1000,max_height=1000|max:".env('MAX_IMAGE_SIZE').'"',
            'path' => 'nullable|mimes:pdf|max:10000',
            'limited' => 'boolean|nullable',
            'order' => 'integer|nullable',
            'is_home' => 'boolean|nullable',
            'active' => 'boolean|nullable',
        ];
    }
}
