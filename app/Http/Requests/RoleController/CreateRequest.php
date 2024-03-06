<?php

namespace App\Http\Requests\RoleController;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:roles',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
