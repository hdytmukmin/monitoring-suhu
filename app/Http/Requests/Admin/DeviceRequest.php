<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeviceRequest extends FormRequest
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
        $deviceId = $this->route('device')?->id;

        return [
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'device_uid' => [
                'required',
                'string',
                'max:100',
                Rule::unique('devices', 'device_uid')->ignore($deviceId),
            ],
            'name' => ['required', 'string', 'max:255'],
            'sensor_type' => ['required', 'string', Rule::in(['DHT11', 'DHT22', 'LM35'])],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'room_id' => 'ruangan',
            'device_uid' => 'device UID',
            'name' => 'nama device',
            'sensor_type' => 'tipe sensor',
            'is_active' => 'status aktif',
        ];
    }
}
