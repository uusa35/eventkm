<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'banner.dimensions' => trans('message.best_fit', ['width' => '1080 px', 'height' => '410 px']),
            'bg.dimensions' => trans('message.best_fit', ['width' => '1080 px', 'height' => '350 px']),
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
            'name' => 'required|min:3|max:200',
            'slug_ar' => 'required|min:3:max:200',
            'slug_en' => 'required|min:3:max:200',
            'description_ar' => 'nullable|min:3',
            'description_en' => 'nullable|min:3',
            'service_ar' => '',
            'service_en' => '',
            'email' => 'required|min:5:max:80|unique:users,email',
            'mobile' => ['nullable','regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/','max:11'],
            'phone' => 'nullable|max:8',
            'fax' => 'nullable|max:8',
            'whatsapp' => 'nullable|max:11',
            'image' => 'required|image|dimensions:width=1000,height=1000',
            'banner' => 'nullable|image|dimensions:width=1080,height=410',
            'bg' => 'nullable|image|dimensions:width=1080,height=350',
            'address' => 'nullable|min:3',
            'area' => 'nullable|string',
            'block' => 'nullable|string',
            'street' => 'nullable|max:100',
            'building' => 'nullable|max:100',
            'floor' => 'nullable|max:100',
            'apartment' => 'nullable|max:100',
            'country_name' => 'nullable|max:100',
            'policy_ar' => 'nullable|max:1000',
            'policy_en' => 'nullable|max:1000',
            'cancellation_ar' => 'nullable|max:1000',
            'cancellation_en' => 'nullable|max:1000',
            'keywords' => 'nullable|max:500',
            'path' => 'nullable|mimes:pdf',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'iphone' => 'nullable|url',
            'android' => 'nullable|url',
            'longitude' => 'nullable|max:100',
            'latitude' => 'nullable|max:100',
            'balance' => 'nullable|numeric',
            'on_home' => 'nullable|boolean',
            'active' => 'nullable|boolean',
            'country_id' => 'required|numeric|exists:countries,id',
            'area_id' => 'required|numeric|exists:areas,id',
            'role_id' => 'required|numeric|exists:roles,id',
            'merchant_id' => 'nullable|max:200|min:3|unique:users,merchant_id',
            'categories' => 'required|array'
        ];
    }
}
