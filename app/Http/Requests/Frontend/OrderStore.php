<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class OrderStore extends FormRequest
{
    protected $redirectRoute = 'frontend.cart.index';
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
            'name' => 'required',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|numeric',
            'address' => 'required|min:5',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
