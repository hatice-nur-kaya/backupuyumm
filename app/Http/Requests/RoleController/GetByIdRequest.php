<?php

namespace App\Http\Requests\RoleController;

use Illuminate\Foundation\Http\FormRequest;

class GetByIdRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:roles,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
