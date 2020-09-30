<?php

namespace App\Http\Requests\BackEnd\Seos;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'page_title' => ['required', 'string'],
            'meta_keywords' => ['required', 'string'],
            'meta_description' => ['required', 'string'],
            'og_title' => ['required', 'string'],
            'og_description' => ['required', 'string'],
            'og_image' => ['required', 'string'],

        ];
    }
}
