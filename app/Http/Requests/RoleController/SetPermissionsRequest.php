<?php

namespace App\Http\Requests\RoleController;

use Illuminate\Foundation\Http\FormRequest;

class SetPermissionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'permissions' => 'required|array',
            'permissions.*' => 'required|integer'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
