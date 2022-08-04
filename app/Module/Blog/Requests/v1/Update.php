<?php

namespace App\Module\Blog\Requests\v1;

use App\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return !! auth()->user();
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|min:4',
            'description' => 'nullable|string|min:8',
            'body' => 'nullable|string|min:16',
            'meta_title' => 'nullable|string|min:4',
            'meta_description' => 'nullable|string|min:8',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(Helpers::arrayPure([
            'title' => Helpers::stripTags(Helpers::toEnglish($this->input('title'))),
            'description' => Helpers::stripTags(Helpers::toEnglish($this->input('description'))),
            'body' => Helpers::stripTags(Helpers::toEnglish($this->input('body'))),
            'meta_title' => Helpers::stripTags(Helpers::toEnglish($this->input('meta_title'))),
            'meta_description' => Helpers::stripTags(Helpers::toEnglish($this->input('meta_description'))),
        ]));
    }
}
