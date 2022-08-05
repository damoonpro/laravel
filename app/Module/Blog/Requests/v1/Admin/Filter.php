<?php

namespace App\Module\Blog\Requests\v1\Admin;

use App\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Filter extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    public function rules()
    {
        return [
            'user' => 'nullable|integer|exists:users,id',
            'filters' => 'nullable|json', // make decision about this
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(Helpers::arrayPure([
            'user' => Helpers::toEnglish($this->input('user')),
            'filters' => json_decode(Helpers::stripTags(Helpers::toEnglish($this->input('filters'))))
            ]));
    }
}
