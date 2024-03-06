<?php

namespace App\Http\Requests\TicketController;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'company_id' => 'required|integer',
            'module_id' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
