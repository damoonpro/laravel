<?php

namespace App\Module\Blog\Requests\v1;

use App\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize()
    {
        return !! auth()->user();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:4',
            'description' => 'required|string|min:8',
            'body' => 'required|string|min:16',
            'meta_title' => 'nullable|string|min:4',
            'meta_description' => 'nullable|string|min:8',
        ];
    }

    protected function prepareForValidation()
    {
        // Install Helpers function to use this ....
        return $this->merge(Helpers::arrayPure([
            'title' => Helpers::stripTags(Helpers::toEnglish($this->input('title'))),
            'description' => Helpers::stripTags(Helpers::toEnglish($this->input('description'))),
            'body' => Helpers::stripTags(Helpers::toEnglish($this->input('body'))),
            'meta_title' => Helpers::stripTags(Helpers::toEnglish($this->input('meta_title'))),
            'meta_description' => Helpers::stripTags(Helpers::toEnglish($this->input('meta_description'))),
        ]));
    }
}
