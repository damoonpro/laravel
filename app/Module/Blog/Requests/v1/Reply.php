<?php

namespace App\Module\Blog\Requests\v1;

use App\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Reply extends FormRequest
{
    public function authorize()
    {
        return !! auth()->user();
    }

    public function rules()
    {
        return [
            'text' => 'required|string|min:3',
            'reply' => 'nullable|integer|exists:replies.id',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(Helpers::arrayPure([
            'text' => Helpers::stripTags(Helpers::toEnglish($this->input('text'))),
            'reply' => Helpers::toEnglish($this->input('reply')),
        ]));
    }
}
