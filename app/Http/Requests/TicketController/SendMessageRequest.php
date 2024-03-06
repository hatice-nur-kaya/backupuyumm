<?php

namespace App\Http\Requests\TicketController;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required|string',
            'id' => 'required|integer'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
