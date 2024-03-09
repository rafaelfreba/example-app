<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class FileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max: 255'],
            'file' => [
                'required',
                File::types(['png', 'jpg'])
                    ->max(1 * 1024), //1MB -> 1024KB
            ]
        ];
    }
}
