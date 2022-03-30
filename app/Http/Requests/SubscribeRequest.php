<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscribeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'website_id' => [
                'required',
                'integer',
                'exists:websites,id'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('subscribers')->where('website_id', $this->website_id),
            ],
        ];
    }
}
