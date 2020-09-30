<?php

namespace App\Http\Requests\BackEnd\Destinations;

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
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required|string|unique:destination_translation,name'];
            $rules += [$locale . '.slug' => 'required|string|unique:destination_translation,slug'];
            $rules += [$locale . '.description' => 'required|string|max:150'];
        }//end of  for each

        return $rules;
    }
}
