<?php

namespace App\Http\Requests\Admin\classroom;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'building_id' => 'required|exists:buildings,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kelas harus diisi.',
            'name.max' => 'Nama kelas tidak boleh lebih dari 255 karakter.',
            'building_id.required' => 'Gedung harus dipilih.',
            'building_id.exists' => 'Gedung yang dipilih tidak valid.',
        ];
    }
}

