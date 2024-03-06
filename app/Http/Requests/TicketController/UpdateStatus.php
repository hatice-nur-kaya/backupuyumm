<?php

namespace App\Http\Requests\TicketController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatus extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'status' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
