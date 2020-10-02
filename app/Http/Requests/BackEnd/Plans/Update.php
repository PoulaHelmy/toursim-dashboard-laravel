<?php

namespace App\Http\Requests\BackEnd\Plans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            $rules += [$locale . '.name' => 'required', 'string', 'max:50', Rule::unique('plan_translations,name')->ignore($this->name)];
        }//end of  for each
        return $rules;

    }
}
