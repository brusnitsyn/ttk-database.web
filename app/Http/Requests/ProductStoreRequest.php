<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'properties' => ['required'],
            'article' => ['required', 'string', 'max:255'],
            'actualPrice' => ['nullable', 'between:0,99999999999.99'],
            'discountPrice' => ['nullable', 'between:0,99999999999.99'],
            'description' => ['string', 'nullable'],
            'brand' => ['string'],
            'type' => ['string'],
            'category' => ['string'],
            'machines' => ['string'],
            'images' => ['array'],
        ];
    }
}
