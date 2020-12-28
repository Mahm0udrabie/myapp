<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOffersRequest extends FormRequest
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
            'name'    => 'required|min:3|max:10',
            'price'   => 'required|numeric',
            'details' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'  => __('messages.offerName'),
            "name.unique" => __("messages.nameExists"),
            'price.required' => __('messages.priceValidate'),
            'price.numeric' => __('messages.priceIsANumber'),
            'details.required' => __("messages.detailsFailed")
        ];
    }
}
