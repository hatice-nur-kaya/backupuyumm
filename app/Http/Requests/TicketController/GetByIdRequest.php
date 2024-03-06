<?php

namespace App\Http\Requests\TicketController;

use Illuminate\Foundation\Http\FormRequest;

class GetByIdRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
