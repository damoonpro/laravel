<?php

namespace App\Http\Requests\v1\Admin\Config\Message;

use Damoon\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    public function rules()
    {
        return [
            'text' => 'required|string|min:3',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'text' => Helpers::stripTags(Helpers::toEnglish($this->input('text'))),
        ]);
    }
}
