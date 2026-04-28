<?php

namespace App\Http\Requests;

use App\Models\Jam_operasional_model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JamOperasionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jam_operasionalId = $this->route('jam_operasional')?->id;

        return [
            'hari' => [
                'required',
                'integer',
                Rule::in(array_keys(Jam_operasional_model::HARI_OPTIONS)),
                Rule::unique('jam_operasionals', 'hari')->ignore($jam_operasionalId),
            ],
            'jam_buka' => ['nullable', 'date_format:H:i'],
            'jam_tutup' => ['nullable', 'date_format:H:i', 'after:jam_buka'],
            'is_closed' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $isClosed = filter_var($this->input('is_closed', false), FILTER_VALIDATE_BOOLEAN);

        $this->merge([
            'hari' => $this->filled('hari') ? (int) $this->input('hari') : null,
            'is_closed' => $isClosed,
        ]);
    }

    public function messages(): array
    {
        return [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Hari yang dipilih tidak valid.',
            'hari.unique' => 'Hari tersebut sudah memiliki jam operasional.',
            'jam_buka.date_format' => 'Format jam buka harus HH:MM.',
            'jam_tutup.date_format' => 'Format jam tutup harus HH:MM.',
            'jam_tutup.after' => 'Jam tutup harus lebih besar dari jam buka.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (!$this->boolean('is_closed') && (!$this->filled('jam_buka') || !$this->filled('jam_tutup'))) {
                $validator->errors()->add('jam_buka', 'Jam buka dan jam tutup wajib diisi jika hari tidak ditandai tutup.');
            }
        });
    }
}
