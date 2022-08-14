<?php

namespace App\Http\Requests\v1\Authenticated\SMS;

use Damoon\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Verify extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile' => ['required', 'regex:/^09(1[0-9]|9[0-9]|3[0-9]|0[1-5]|2[0-2])-?[0-9]{3}-?[0-9]{4}$/'],
            'code' => 'required|integer|min:100000|max:999999',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'mobile' => Helpers::toEnglish($this->input('mobile')),
            'code' => Helpers::toEnglish($this->input('code')),
        ]);
    }
}
