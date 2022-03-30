<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'body' => [
                'required',
                'string',
                'max:15000'
            ],
        ];
    }
}
