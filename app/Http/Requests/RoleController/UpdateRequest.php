<?php

namespace App\Http\Requests\RoleController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|max:255'
            ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
