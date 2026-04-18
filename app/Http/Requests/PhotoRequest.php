<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // admin harus login, kita atur di middleware
    }

    public function rules(): array
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
        ];

        if ($this->isMethod('post')) {
            $rules['gambar'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['gambar'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}