<?php

namespace App\Http\Requests\Frontend;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|max:500',
            'name_en' => 'required|max:500',
            'email' => 'string|email|max:255',
            'mobile' => 'required|numeric',
            'address' => 'nullable|min:5|max:500',
            'country_id' => 'required|exists:countries,id',
            'area_id' => 'nullable|exists:areas,id',
            'images' => 'array|required',
            'description_ar' => 'required|string|min:10:max:500',
            'description_en' => 'required|string|min:10:max:500',
            'address' => 'required|string|min:5:max:500',
        ];
    }
}
