<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ClassifiedUpdate extends FormRequest
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
            'image.dimensions' => trans('message.best_fit', ['width' => '1080 px', 'height' => '1440px']),
            'size_chart.dimensions' => trans('message.best_fit', ['width' => '1440 px', 'height' => '1080 px']),
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
            'name_ar' => 'required:min:3|max:200',
            'name_en' => 'required|min:3|max:200',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|dimensions:width=1080,height=1440|max:600',
            'price' => 'required|numeric|min:0.5|max:999999',
            'on_home' => 'boolean',
            'description_en' => 'min:5|required|string|max:500',
            'description_ar' => 'min:5|required|string|max:500',
            'address' => 'min:5|nullable|string|max:500',
            'active' => 'required|boolean',
            'tags' => 'array',
            'video_url' => 'nullable|url',
            'video_url_one' => 'nullable|url',
            'video_url_two' => 'nullable|url',
            'video_url_three' => 'nullable|url',
            'video_url_four' => 'nullable|url',
            'video_url_five' => 'nullable|url',
            'area_id' => 'nullable|exists:areas,id',
            'country_id' => 'nullable|exists:countries,id',
        ];
    }
}
