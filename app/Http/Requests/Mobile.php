<?php

namespace App\Http\Requests;

use Damoon\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

// this class has no version because mobile is mobile this validation will never change
class Mobile extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile' => ['required', 'regex:/^09(1[0-9]|9[0-9]|3[0-9]|0[1-5]|2[0-2])-?[0-9]{3}-?[0-9]{4}$/'],
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'mobile' => Helpers::toEnglish($this->input('mobile')),
        ]);
    }
}
