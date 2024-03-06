<?php

namespace App\Http\Requests\RoleController;

use Illuminate\Foundation\Http\FormRequest;

class GetAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
