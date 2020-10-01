<?php

namespace App\Http\Requests\BackEnd\Categories;

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
            $rules += [$locale . '.name' => 'required|string|unique:category_translations,name'];
            $rules += [$locale . '.slug' => 'required|string|unique:category_translations,slug'];
            $rules += [$locale . '.description' => 'required|string|max:150'];
            $rules += [$locale . '.page_title' => 'string|max:150'];
            $rules += [$locale . '.meta_keywords' => 'string'];
            $rules += [$locale . '.meta_description' => 'string'];
            $rules += [$locale . '.og_title' => 'string'];
            $rules += [$locale . '.og_description' => 'string'];
            $rules += [$locale . '.og_image' => 'required|image:mimes,jpeg,png,gif'];
        }//end of  for each

        return $rules;
    }
}
