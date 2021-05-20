<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStore extends FormRequest
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
            'name_ar' => 'required|unique:currencies,name_ar',
            'name_en' => 'required|unique:currencies,name_en',
            'currency_symbol_ar' => 'required|unique:currencies,currency_symbol_ar',
            'currency_symbol_en' => 'required|unique:currencies,currency_symbol_en',
            'exchange_rate' => 'required|numeric',
            'country_id' => 'required|unique:currencies,country_id|exists:countries,id',
        ];
    }
}
