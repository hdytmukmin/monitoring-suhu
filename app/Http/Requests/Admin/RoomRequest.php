<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roomId = $this->route('room')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('rooms', 'code')->ignore($roomId),
            ],
            'location' => ['nullable', 'string', 'max:255'],
            'warning_temperature' => ['required', 'numeric', 'between:-20,80', 'lt:danger_temperature'],
            'danger_temperature' => ['required', 'numeric', 'between:-20,80', 'gt:warning_temperature'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama ruangan',
            'code' => 'kode ruangan',
            'location' => 'lokasi',
            'warning_temperature' => 'batas waspada',
            'danger_temperature' => 'batas bahaya',
            'is_active' => 'status aktif',
        ];
    }

}
