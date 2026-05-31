<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSensorReadingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'device_id' => ['required', 'string', 'max:100'],
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'temperature' => ['required', 'numeric', 'between:-20,80'],
            'humidity' => ['nullable', 'numeric', 'between:0,100'],
            'timestamp' => ['nullable', 'date'],
        ];
    }
}
