<?php

namespace App\Http\Requests\Admin;

use App\Models\NotificationSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationSettingRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'room_id' => $this->input('room_id') ?: null,
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
            'channel' => [
                'required',
                'string',
                Rule::in([
                    NotificationSetting::CHANNEL_TELEGRAM,
                    NotificationSetting::CHANNEL_WHATSAPP,
                ]),
            ],
            'recipient' => ['required', 'string', 'max:255'],
            'cooldown_minutes' => ['required', 'integer', 'between:1,1440'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'room_id' => 'ruangan',
            'channel' => 'channel',
            'recipient' => 'recipient',
            'cooldown_minutes' => 'cooldown notifikasi',
            'is_active' => 'status aktif',
        ];
    }
}
