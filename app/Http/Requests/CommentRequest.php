<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
