<?php

namespace App\Http\Requests\BackEnd\Excursions;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            $rules += [$locale . '.name' => 'required|string'];
            $rules += [$locale . '.slug' => 'required|string'];
            $rules += [$locale . '.short_description' => 'required|string|max:150'];
            $rules += [$locale . '.overview' => 'required|string'];

            $rules += [$locale . '.includes' => 'required|string|max:150'];
            $rules += [$locale . '.excludes' => 'required|string|max:150'];

            $rules += [$locale . '.run' => 'required|string|max:150'];
            $rules += [$locale . '.type' => 'required|string|max:150'];

            $rules += ['duration' => 'required|integer'];
            $rules += ['start' => 'required|integer'];
            $rules += ['discount' => 'integer'];
            $rules += ['status' => 'integer'];
            $rules += ['featured' => 'integer'];
            $rules += ['destination_id' => 'required|integer'];
            $rules += ['categories.*' => 'required|integer'];
            $rules += ['slider.*' => 'required|image:mimes,jpeg,png,gif'];

            $rules += ['banner_url' => 'required|image:mimes,jpeg,png,gif'];
            $rules += ['banner_alt' => 'required|string|max:150'];
            $rules += ['thumb_url' => 'required|image:mimes,jpeg,png,gif'];
            $rules += ['thumb_alt' => 'required|string|max:150'];

            $rules += [$locale . '.page_title' => 'required|string|max:150'];
            $rules += [$locale . '.meta_keywords' => 'required|string'];
            $rules += [$locale . '.meta_description' => 'required|string'];
            $rules += [$locale . '.og_title' => 'required|string'];
            $rules += [$locale . '.og_description' => 'required|string'];
            $rules += [$locale . '.og_image' => 'required|image:mimes,jpeg,png,gif'];

        }//end of  for each
        return $rules;
    }
}
