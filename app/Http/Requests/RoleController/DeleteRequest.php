<?php

namespace App\Http\Requests\RoleController;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:roles,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
