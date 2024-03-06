<?php

namespace App\Http\Requests\FrontendController;

use Illuminate\Foundation\Http\FormRequest;

class GetAllCompaniesRequest extends FormRequest
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
